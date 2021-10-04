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
            $table->foreign('user_id')->references('id')->on('students');
            $table->string('regno');
            $table->string('title');
            $table->string('language');
            $table->string('project_type');
            $table->text('description');
            $table->string('status')->default('pending');
            $table->text('comment')->nullable();
            $table->date('presentation_date')->nullable();
            $table->string('room')->nullable();
            $table->boolean('isAwarded')->default(false);
            $table->boolean('isFixed')->default(false);
            $table->integer('marks')->nullable();
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
