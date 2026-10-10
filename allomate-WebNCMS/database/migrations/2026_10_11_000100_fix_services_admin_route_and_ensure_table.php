<?php

use App\Support\DottscaleCmsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Fix /admin/Services 404: controllers.controller "Services" → "website-services".
 * Also ensure services table exists and seed default service cards.
 */
class FixServicesAdminRouteAndEnsureTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->increments('id');
                $table->string('service_name')->nullable();
                $table->string('slug')->nullable();
                $table->text('description')->nullable();
                $table->string('icon', 500)->nullable();
                $table->string('route', 500)->nullable();
                $table->integer('sort_order')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('controllers')) {
            // Rename broken menu slugs → real route
            DB::table('controllers')
                ->where(function ($q) {
                    $q->where('controller', 'Services')
                        ->orWhere('controller', 'services')
                        ->orWhere('controller', 'Service')
                        ->orWhere(function ($q2) {
                            $q2->where('sub_module', 'Services')
                                ->where('parent_module', 'Website Pages')
                                ->whereNotIn('controller', ['website-services']);
                        });
                })
                ->update([
                    'controller' => 'website-services',
                    'made_up_name' => 'Website Services',
                    'sub_module' => 'Services',
                    'parent_module' => 'Website Pages',
                    'show_in_sidebar' => 1,
                    'show_in_sub_menu' => 1,
                ]);

            // Ensure one website-services menu row exists
            $exists = DB::table('controllers')->where('controller', 'website-services')->exists();
            if (!$exists) {
                $nextId = ((int) DB::table('controllers')->max('id')) + 1;
                DB::table('controllers')->insert([
                    'id' => $nextId,
                    'controller' => 'website-services',
                    'made_up_name' => 'Website Services',
                    'parent_module' => 'Website Pages',
                    'sub_module' => 'Services',
                    'sub_module_priority' => 0,
                    'parent_module_priority' => 7,
                    'show_in_sidebar' => 1,
                    'show_in_sub_menu' => 1,
                    'admin_right' => 0,
                    'sub_menu_icon' => 'activity-icon.svg',
                    'logo' => 'dashboard-icon.svg',
                ]);
            }

            // Deduplicate if both Services+website-services existed and both became website-services
            $ids = DB::table('controllers')
                ->where('controller', 'website-services')
                ->orderBy('id')
                ->pluck('id');
            if ($ids->count() > 1) {
                DB::table('controllers')
                    ->whereIn('id', $ids->slice(1)->values()->all())
                    ->delete();
            }
        }

        // Seed service cards if table empty / missing defaults
        if (class_exists(DottscaleCmsSeeder::class)) {
            DottscaleCmsSeeder::run();
        }
    }

    public function down()
    {
        // Keep CMS data.
    }
}
