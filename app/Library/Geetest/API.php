<?php
namespace App\Library\Geetest; use App\Library\Helper; use Hashids\Hashids; use Illuminate\Support\Facades\Session; class API { private $geetest_conf = null; public function __construct($spfdba56) { $this->geetest_conf = $spfdba56; } public static function get() { $sp258ace = config('services.geetest.id'); $sp2121a2 = config('services.geetest.key'); if (!strlen($sp258ace) || !strlen($sp2121a2)) { return array('message' => 'geetest error: no config'); } $sp0fe6af = new Lib($sp258ace, $sp2121a2); $sp3546ff = time() . rand(1, 10000); $spda95b0 = $sp0fe6af->pre_process($sp3546ff); $spced997 = json_decode($sp0fe6af->get_response_str(), true); $spced997['key'] = Helper::id_encode($sp3546ff, 3566, $spda95b0); return $spced997; } public static function verify($sp589737, $spca2171, $sp2f72d6, $sp4f1bb0) { $sp0fe6af = new Lib(config('services.geetest.id'), config('services.geetest.key')); Helper::id_decode($sp589737, 3566, $sp0f50ef); $sp3546ff = $sp0f50ef[1]; $spda95b0 = $sp0f50ef[4]; if ($spda95b0 === 1) { $sp33dd24 = $sp0fe6af->success_validate($spca2171, $sp2f72d6, $sp4f1bb0, $sp3546ff); if ($sp33dd24) { return true; } else { return false; } } else { if ($sp0fe6af->fail_validate($spca2171, $sp2f72d6, $sp4f1bb0)) { return true; } else { return false; } } } }