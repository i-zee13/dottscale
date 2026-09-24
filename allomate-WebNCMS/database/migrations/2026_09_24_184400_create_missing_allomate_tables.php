<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissingAllomateTables extends Migration
{
    public function up()
    {
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

        if (!Schema::hasTable('application_forms')) {
            Schema::create('application_forms', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('application_for')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone_number')->nullable();
                $table->text('message')->nullable();
                $table->string('linked_in')->nullable();
                $table->string('resume')->nullable();
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
    }

    public function down()
    {
        Schema::dropIfExists('contact_us_forms');
        Schema::dropIfExists('application_forms');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('reports_types');
    }
}
