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
        Schema::create('request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('description');
            $table->integer('qty');
            $table->enum('status', ['Menunggu Persetujuan','Ditolak','Diterima'])->default('Menunggu Persetujuan');
            $table->string('feedback')->nullable();
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
        Schema::dropIfExists('request_items');
    }
};
