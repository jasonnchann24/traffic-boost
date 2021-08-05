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
        Schema::create('users', function (Blueprint $collection) {
            // $collection->id();
            // $collection->uuid('uuid')->index();
            // $collection->foreignId('role_id')->constrained('roles');
            // $collection->string('name');
            // $collection->string('email')->unique();
            // $collection->timestamp('email_verified_at')->nullable();
            // $collection->boolean('is_suspended')->default(0);
            // $collection->string('password');
            // $collection->rememberToken();
            // $collection->timestamps();
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
