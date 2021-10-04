<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('regno');
            $table->string('email');
            $table->string('title');
            $table->string('language');
            $table->string('project_type');
            $table->text('description');
            $table->string('status')->default('pending');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
