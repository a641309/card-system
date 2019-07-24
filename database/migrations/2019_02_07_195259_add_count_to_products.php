<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class AddCountToProducts extends Migration { public function up() { if (!Schema::hasColumn('products', 'count_all')) { Schema::table('products', function (Blueprint $spab94ff) { $spab94ff->integer('count_all')->default(0)->after('count_sold'); }); App\Product::whereRaw('1')->update(array('count_sold' => 0, 'count_all' => 0)); \App\Card::selectRaw('`product_id`,SUM(`count_sold`) as `count_sold`,SUM(`count_all`) as `count_all`')->groupBy('product_id')->orderByRaw('`product_id`')->chunk(100, function ($spa1cb2d) { foreach ($spa1cb2d as $spd384ba) { \App\Product::where('id', $spd384ba->product_id)->update(array('count_sold' => $spd384ba->count_sold, 'count_all' => $spd384ba->count_all)); } }); } } public function down() { if (Schema::hasColumn('products', 'count_all')) { Schema::table('products', function (Blueprint $spab94ff) { $spab94ff->dropColumn(array('count_all')); }); } } }