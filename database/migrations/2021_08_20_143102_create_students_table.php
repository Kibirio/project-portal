<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('regno')->unique();
            $table->unsignedbigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('student_name');
            $table->string('school')->default('SCI');
            $table->string('department')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->mediumText('bio')->nullable();
            $table->string('photo')->default('profile.png')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
