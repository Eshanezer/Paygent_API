<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('year');
            $table->integer('year');
            $table->integer('year');
            $table->integer('year');
            $table->integer('year');
            // $table->string('customer_id', 18);
            // $table->string('postal_code', 8);
            // $table->integer('prefecture');
            // $table->string('municipalities', 26);
            // $table->string('town_area_address', 26);
            // $table->string('building_number_room', 26);
            // $table->string('surname', 10);
            // $table->string('name', 10);
            // $table->string('last_name_kana', 20);
            // $table->string('name_kana', 20);
            // $table->enum('gender', [1, 2]);
            // $table->date('dob');
            // $table->string('home_phone', 11);
            // $table->string('mobile_phone', 11);
            // $table->string('phone', 11);
            // $table->string('fax', 11);
            // $table->enum('status', [1, 2]);
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
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
};
