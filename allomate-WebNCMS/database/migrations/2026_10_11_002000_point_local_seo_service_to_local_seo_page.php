<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('services')) {
            DB::table('services')
                ->where(function ($q) {
                    $q->where('slug', 'local-seo')
                        ->orWhere('service_name', 'Local SEO');
                })
                ->update([
                    'route' => 'services/local-seo',
                    'updated_at' => now(),
                ]);
        }

        if (Schema::hasTable('home') && Schema::hasColumn('home', 'visibility_cta_link')) {
            DB::table('home')
                ->where('visibility_cta_link', 'services/enterprise-solutions')
                ->update([
                    'visibility_cta_link' => 'services/local-seo',
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('services')) {
            DB::table('services')
                ->where(function ($q) {
                    $q->where('slug', 'local-seo')
                        ->orWhere('service_name', 'Local SEO');
                })
                ->update([
                    'route' => 'services/enterprise-solutions',
                    'updated_at' => now(),
                ]);
        }

        if (Schema::hasTable('home') && Schema::hasColumn('home', 'visibility_cta_link')) {
            DB::table('home')
                ->where('visibility_cta_link', 'services/local-seo')
                ->update([
                    'visibility_cta_link' => 'services/enterprise-solutions',
                    'updated_at' => now(),
                ]);
        }
    }
};


