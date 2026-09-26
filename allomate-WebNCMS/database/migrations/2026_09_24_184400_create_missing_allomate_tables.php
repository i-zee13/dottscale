<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMissingAllomateTables extends Migration
{
    public function up()
    {
        $this->ensureAutoIncrementPrimaryKey('migrations');
        $this->ensureAutoIncrementPrimaryKey('organization');

        if (!Schema::hasTable('reports_types')) {
            Schema::create('reports_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('report_type');
                $table->tinyInteger('status')->default(1);
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('reports')) {
            Schema::create('reports', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('report_type_id')->nullable();
                $table->string('report_title')->nullable();
                $table->text('report_description')->nullable();
                $table->date('publish_date')->nullable();
                $table->string('report_file')->nullable();
                $table->string('slug')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('contact_us_forms')) {
            Schema::create('contact_us_forms', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('subject')->nullable();
                $table->text('message')->nullable();
                $table->string('page_reference')->nullable();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('organization')) {
            $payload = [
                'name' => 'DottScale',
                'phone_number' => '+1 (512) 564-8959',
                'email' => 'contact@dottscale.com',
                'address' => 'Austin, Texas, United States',
                'fb_link' => 'www.facebook.com/dottscalee/',
                'insta_link' => 'www.instagram.com/dottscale',
                'linkedin_link' => 'www.linkedin.com/company/dottscale/',
                'twitter_link' => 'www.pinterest.com/dottscale',
                'thankyou_page_title' => 'Thank you',
                'thankyou_page_message' => '<p>We have received your inquiry. A member of our team will be in touch shortly.</p>',
                'updated_at' => now(),
            ];

            if (Schema::hasColumn('organization', 'page_meta_tags')) {
                $payload['page_meta_tags'] = json_encode([
                    'page_title' => 'DottScale | Business Transformation Through Tech',
                    'meta_description' => 'DottScale builds enterprise software, web & mobile apps, MVPs, AI and automation. Driving growth, efficiency, and digital transformation.',
                    'meta_og_title' => 'DottScale | Business Transformation Through Tech',
                    'meta_og_description' => 'DottScale helps businesses move forward with enterprise software, web & mobile apps, AI, automation, and dedicated teams. Results, not buzzwords.',
                    'meta_og_image' => '/images/dottscale-logo-alt.png',
                    'is_indexable' => '1',
                    'is_followable' => '1',
                ]);
            }

            DB::table('organization')->update($payload);
        }
    }

    private function ensureAutoIncrementPrimaryKey(string $table): void
    {
        if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'id')) {
            return;
        }

        $hasPrimary = collect(DB::select("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'"))->isNotEmpty();
        if (!$hasPrimary) {
            DB::statement("ALTER TABLE `{$table}` ADD PRIMARY KEY (`id`)");
        }

        DB::statement("ALTER TABLE `{$table}` MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT");
    }

    public function down()
    {
        Schema::dropIfExists('contact_us_forms');
        Schema::dropIfExists('application_forms');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('reports_types');
    }
}
