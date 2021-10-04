<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('regno');
            $table->unsignedbigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('supervisor');
            $table->string('name');
            $table->string('school')->default('SCI');
            $table->string('department');
            $table->string('marks')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->default('student');
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
        Schema::dropIfExists('users');
    }
}
