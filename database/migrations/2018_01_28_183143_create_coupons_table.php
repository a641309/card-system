<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateCouponsTable extends Migration { public function up() { Schema::create('coupons', function (Blueprint $spab94ff) { $spab94ff->increments('id'); $spab94ff->integer('user_id')->index(); $spab94ff->integer('category_id')->default(-1); $spab94ff->integer('product_id')->default(-1); $spab94ff->integer('type')->default(\App\Coupon::TYPE_REPEAT); $spab94ff->integer('status')->default(\App\Coupon::STATUS_NORMAL); $spab94ff->string('coupon', 100)->index(); $spab94ff->integer('discount_type'); $spab94ff->integer('discount_val'); $spab94ff->integer('count_used')->default(0); $spab94ff->integer('count_all')->default(1); $spab94ff->string('remark')->nullable(); $spab94ff->dateTime('expire_at')->nullable(); $spab94ff->timestamps(); }); } public function down() { Schema::dropIfExists('coupons'); } }