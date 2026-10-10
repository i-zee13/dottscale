<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddHomeSectionsOrderJson extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('home')) {
            return;
        }

        if (!Schema::hasColumn('home', 'sections_order_json')) {
            Schema::table('home', function (Blueprint $table) {
                $table->longText('sections_order_json')->nullable();
            });
        }

        $defaults = json_encode([
            'hero' => 1,
            'stats' => 2,
            'services' => 3,
            'why' => 4,
            'about' => 5,
            'process' => 6,
            'proof' => 7,
            'industries' => 8,
            'visibility' => 9,
            'cta' => 10,
        ]);

        if (DB::table('home')->count() > 0) {
            DB::table('home')->where(function ($q) {
                $q->whereNull('sections_order_json')->orWhere('sections_order_json', '');
            })->update([
                'sections_order_json' => $defaults,
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        // Keep column.
    }
}
