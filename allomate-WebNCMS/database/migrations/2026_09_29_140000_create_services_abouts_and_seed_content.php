<?php

use App\Support\DottscaleCmsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesAboutsAndSeedContent extends Migration
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

        if (!Schema::hasTable('abouts')) {
            Schema::create('abouts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('heading_1')->nullable();
                $table->text('heading_2')->nullable();
                $table->string('cta_text')->nullable();
                $table->string('story_eyebrow')->nullable();
                $table->string('story_heading')->nullable();
                $table->text('story_p1')->nullable();
                $table->text('story_p2')->nullable();
                $table->string('belief_title')->nullable();
                $table->text('belief_text')->nullable();
                $table->string('direction_title')->nullable();
                $table->text('direction_text')->nullable();
                $table->string('promise_title')->nullable();
                $table->text('promise_text')->nullable();
                $table->text('values_intro')->nullable();
                $table->longText('values_json')->nullable();
                $table->longText('page_meta_tags')->nullable();
                $table->string('meta_og_image', 500)->nullable();
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }

        DottscaleCmsSeeder::run();
    }

    public function down()
    {
        // Keep seeded CMS content.
    }
}
