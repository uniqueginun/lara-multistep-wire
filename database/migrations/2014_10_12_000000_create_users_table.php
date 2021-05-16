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
            $table->string('name');
            $table->string('personal_id')->unique();
            $table->string('password');
            $table->timestamp('account_activated_at')->nullable();
            $table->rememberToken();
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('profile_photo_path')->nullable();
            $table->unsignedTinyInteger('role')->default(1)->index();
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
