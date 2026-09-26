<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioCategoriesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('portfolio_categories')) {
            Schema::create('portfolio_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('service_name')->nullable();
                $table->tinyInteger('publish')->default(1);
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('portfolios')) {
            Schema::create('portfolios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('portfolio_name')->nullable();
                $table->string('page_route')->nullable();
                $table->string('page_title')->nullable();
                $table->text('categories')->nullable();
                $table->tinyInteger('is_slider_show')->default(0);
                $table->string('thumbnail')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->longText('page_meta_tags')->nullable();
                $table->string('meta_og_image')->nullable();
                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
        Schema::dropIfExists('portfolio_categories');
    }
}
