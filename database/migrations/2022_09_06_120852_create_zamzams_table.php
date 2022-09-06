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
        Schema::create('zamzams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('amount');
            $table->string('image');
            $table->float('old_price');
            $table->float('new_price');
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
        Schema::dropIfExists('zamzams');
    }
};
