<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc');
            $table->integer('user_id');
            $table->unsignedInteger('seq')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();
        });

        \App\User::create(['name' => 'Mingchao Liao', 'email' => 'mingchaoliao95@gmail.com', 'password' => '$2y$10$aQOhOO3YHX4ZHaWs9P3kDuMrKH6ZF41Lk/rZR0lZLaHoGPfm6bpp2']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
