<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInviteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('section_id')->on('sections');
            $table->integer('role_id');
            $table->string('email')->unique();
            $table->string('token');
            $table->integer('invited_by');
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
        Schema::dropIfExists('invite_users');
    }
}
