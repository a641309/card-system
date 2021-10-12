<?php
namespace App; use App\Library\Helper; use Illuminate\Database\Eloquent\Model; class PayWay extends Model { protected $guarded = array(); protected $casts = array('channels' => 'array'); const ENABLED_DISABLED = 0; const ENABLED_PC = 1; const ENABLED_MOBILE = 2; const ENABLED_ALL = 3; const TYPE_SHOP = 1; const TYPE_API = 2; public function getPayByWeight() { $spad28c0 = $sp2a1c72 = 0; $spb6ef11 = array(); $sp3cf93f = array(); foreach ($this->channels as $sp185233) { $sp3cf93f[] = intval($sp185233[0]); } $spaee92c = \App\Pay::gets()->filter(function ($sp7a9e03) use($sp3cf93f) { return in_array($sp7a9e03->id, $sp3cf93f); }); $sp1bfc6b = array(); foreach ($spaee92c as $spf75eb7) { $sp1bfc6b[$spf75eb7->id] = $spf75eb7; } foreach ($this->channels as $sp185233) { $spab3d63 = intval($sp185233[0]); $spbe5a61 = intval($sp185233[1]); if ($spbe5a61 && isset($sp1bfc6b[$spab3d63]) && $sp1bfc6b[$spab3d63]->enabled > 0) { $spad28c0 += $spbe5a61; $spa287cf = $sp2a1c72 + $spbe5a61; $spb6ef11[] = array('min' => $sp2a1c72, 'max' => $spa287cf, 'pay_id' => $spab3d63); $sp2a1c72 = $spa287cf; } } if ($spad28c0 <= 0) { return null; } $sp55f9b4 = mt_rand(0, $spad28c0 - 1); foreach ($spb6ef11 as $spee77de) { if ($spee77de['min'] <= $sp55f9b4 && $sp55f9b4 < $spee77de['max']) { return $sp1bfc6b[$spee77de['pay_id']]; } } return null; } public static function gets($sp24cedd, $spea343c = null) { $sp90af04 = self::query(); if ($spea343c !== null) { $sp90af04->where($spea343c); } $sp0b0c0c = $sp90af04->orderBy('sort')->get(array('name', 'img', 'channels')); $sp896686 = array(); foreach ($sp0b0c0c as $sp5ceb29) { $sp7a9e03 = $sp5ceb29->getPayByWeight(); if ($sp7a9e03) { $sp7a9e03->setAttribute('name', $sp5ceb29->name); $sp7a9e03->setAttribute('img', $sp5ceb29->img); $sp7a9e03->setVisible(array('id', 'name', 'img', 'fee')); $sp896686[] = $sp7a9e03; } } return $sp896686; } }