<?php
namespace App\Http\Controllers\Merchant; use App\Library\Response; use Carbon\Carbon; use Illuminate\Http\Request; use App\Http\Controllers\Controller; class Coupon extends Controller { function get(Request $sp510ef3) { $sp90af04 = $this->authQuery($sp510ef3, \App\Coupon::class)->with(array('category' => function ($sp90af04) { $sp90af04->select(array('id', 'name')); }))->with(array('product' => function ($sp90af04) { $sp90af04->select(array('id', 'name')); })); $spebf2d9 = $sp510ef3->input('search', false); $spac3bf6 = $sp510ef3->input('val', false); if ($spebf2d9 && $spac3bf6) { if ($spebf2d9 == 'id') { $sp90af04->where('id', $spac3bf6); } else { $sp90af04->where($spebf2d9, 'like', '%' . $spac3bf6 . '%'); } } $sp40435f = (int) $sp510ef3->input('category_id'); $sp2f9632 = $sp510ef3->input('product_id', -1); if ($sp40435f > 0) { if ($sp2f9632 > 0) { $sp90af04->where('product_id', $sp2f9632); } else { $sp90af04->where('category_id', $sp40435f); } } $sp671ce9 = $sp510ef3->input('status'); if (strlen($sp671ce9)) { $sp90af04->whereIn('status', explode(',', $sp671ce9)); } $spb2a0bb = $sp510ef3->input('type'); if (strlen($spb2a0bb)) { $sp90af04->whereIn('type', explode(',', $spb2a0bb)); } $sp90af04->orderByRaw('expire_at DESC,category_id,product_id,type,status'); $spb02a8e = (int) $sp510ef3->input('current_page', 1); $sp95f730 = (int) $sp510ef3->input('per_page', 20); $spe24324 = $sp90af04->paginate($sp95f730, array('*'), 'page', $spb02a8e); return Response::success($spe24324); } function create(Request $sp510ef3) { $spad28c0 = $sp510ef3->post('count', 0); $spb2a0bb = (int) $sp510ef3->post('type', \App\Coupon::TYPE_ONETIME); $sp8e0d9d = $sp510ef3->post('expire_at'); $sp573dfd = (int) $sp510ef3->post('discount_val'); $sp5de0f1 = (int) $sp510ef3->post('discount_type', \App\Coupon::DISCOUNT_TYPE_AMOUNT); $sp48a8d4 = $sp510ef3->post('remark'); if ($sp5de0f1 === \App\Coupon::DISCOUNT_TYPE_AMOUNT) { if ($sp573dfd < 1 || $sp573dfd > 1000000000) { return Response::fail('优惠券面额需要在0.01-10000000之间'); } } if ($sp5de0f1 === \App\Coupon::DISCOUNT_TYPE_PERCENT) { if ($sp573dfd < 1 || $sp573dfd > 100) { return Response::fail('优惠券面额需要在1-100之间'); } } $sp40435f = (int) $sp510ef3->post('category_id', -1); $sp2f9632 = (int) $sp510ef3->post('product_id', -1); if ($spb2a0bb === \App\Coupon::TYPE_REPEAT) { $spa1dd92 = $sp510ef3->post('coupon'); if (!$spa1dd92) { $spa1dd92 = strtoupper(str_random()); } $spdbfd09 = new \App\Coupon(); $spdbfd09->user_id = $this->getUserIdOrFail($sp510ef3); $spdbfd09->category_id = $sp40435f; $spdbfd09->product_id = $sp2f9632; $spdbfd09->coupon = $spa1dd92; $spdbfd09->type = $spb2a0bb; $spdbfd09->discount_val = $sp573dfd; $spdbfd09->discount_type = $sp5de0f1; $spdbfd09->count_all = (int) $sp510ef3->post('count_all', 1); if ($spdbfd09->count_all < 1 || $spdbfd09->count_all > 10000000) { return Response::fail('可用次数不能超过10000000'); } $spdbfd09->expire_at = $sp8e0d9d; $spdbfd09->saveOrFail(); return Response::success(array($spdbfd09->coupon)); } elseif ($spb2a0bb === \App\Coupon::TYPE_ONETIME) { if (!$spad28c0) { return Response::forbidden('请输入生成数量'); } if ($spad28c0 > 100) { return Response::forbidden('每次生成不能大于100张'); } $sp16f28c = array(); $sp8fbec9 = array(); $sp3546ff = $this->getUserIdOrFail($sp510ef3); $sp7c7c21 = Carbon::now(); for ($sp59ca22 = 0; $sp59ca22 < $spad28c0; $sp59ca22++) { $spdbfd09 = strtoupper(str_random()); $sp8fbec9[] = $spdbfd09; $sp16f28c[] = array('user_id' => $sp3546ff, 'coupon' => $spdbfd09, 'category_id' => $sp40435f, 'product_id' => $sp2f9632, 'type' => $spb2a0bb, 'discount_val' => $sp573dfd, 'discount_type' => $sp5de0f1, 'status' => \App\Coupon::STATUS_NORMAL, 'remark' => $sp48a8d4, 'created_at' => $sp7c7c21, 'expire_at' => $sp8e0d9d); } \App\Coupon::insert($sp16f28c); return Response::success($sp8fbec9); } else { return Response::forbidden('unknown type: ' . $spb2a0bb); } } function edit(Request $sp510ef3) { $sp258ace = (int) $sp510ef3->post('id'); $spa1dd92 = $sp510ef3->post('coupon'); $sp40435f = (int) $sp510ef3->post('category_id', -1); $sp2f9632 = (int) $sp510ef3->post('product_id', -1); $sp8e0d9d = $sp510ef3->post('expire_at', NULL); $sp671ce9 = (int) $sp510ef3->post('status', \App\Coupon::STATUS_NORMAL); $spb2a0bb = (int) $sp510ef3->post('type', \App\Coupon::TYPE_ONETIME); $sp573dfd = (int) $sp510ef3->post('discount_val'); $sp5de0f1 = (int) $sp510ef3->post('discount_type', \App\Coupon::DISCOUNT_TYPE_AMOUNT); if ($sp5de0f1 === \App\Coupon::DISCOUNT_TYPE_AMOUNT) { if ($sp573dfd < 1 || $sp573dfd > 1000000000) { return Response::fail('优惠券面额需要在0.01-10000000之间'); } } if ($sp5de0f1 === \App\Coupon::DISCOUNT_TYPE_PERCENT) { if ($sp573dfd < 1 || $sp573dfd > 100) { return Response::fail('优惠券面额需要在1-100之间'); } } $spdbfd09 = $this->authQuery($sp510ef3, \App\Coupon::class)->find($sp258ace); if ($spdbfd09) { $spdbfd09->coupon = $spa1dd92; $spdbfd09->category_id = $sp40435f; $spdbfd09->product_id = $sp2f9632; $spdbfd09->status = $sp671ce9; $spdbfd09->type = $spb2a0bb; $spdbfd09->discount_val = $sp573dfd; $spdbfd09->discount_type = $sp5de0f1; if ($spb2a0bb === \App\Coupon::TYPE_REPEAT) { $spdbfd09->count_all = (int) $sp510ef3->post('count_all', 1); if ($spdbfd09->count_all < 1 || $spdbfd09->count_all > 10000000) { return Response::fail('可用次数不能超过10000000'); } } if ($sp8e0d9d) { $spdbfd09->expire_at = $sp8e0d9d; } $spdbfd09->saveOrFail(); } else { $sp92012e = explode('
', $spa1dd92); for ($sp59ca22 = 0; $sp59ca22 < count($sp92012e); $sp59ca22++) { $spd13a45 = str_replace('', '', trim($sp92012e[$sp59ca22])); $spdbfd09 = new \App\Coupon(); $spdbfd09->coupon = $spd13a45; $spdbfd09->category_id = $sp40435f; $spdbfd09->product_id = $sp2f9632; $spdbfd09->status = $sp671ce9; $spdbfd09->type = $spb2a0bb; $spdbfd09->discount_val = $sp573dfd; $spdbfd09->discount_type = $sp5de0f1; $sp92012e[$sp59ca22] = $spdbfd09; } \App\Product::find($sp2f9632)->coupons()->saveMany($sp92012e); } return Response::success(); } function enable(Request $sp510ef3) { $this->validate($sp510ef3, array('ids' => 'required|string', 'enabled' => 'required|integer|between:0,1')); $sp3cf93f = $sp510ef3->post('ids'); $sp73556e = (int) $sp510ef3->post('enabled'); $this->authQuery($sp510ef3, \App\Coupon::class)->whereIn('id', explode(',', $sp3cf93f))->update(array('enabled' => $sp73556e)); return Response::success(); } function delete(Request $sp510ef3) { $this->validate($sp510ef3, array('ids' => 'required|string')); $sp3cf93f = $sp510ef3->post('ids'); $this->authQuery($sp510ef3, \App\Coupon::class)->whereIn('id', explode(',', $sp3cf93f))->delete(); return Response::success(); } }