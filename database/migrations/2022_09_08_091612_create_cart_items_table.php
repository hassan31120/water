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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('amount');
            $table->string('image')->nullable();
            $table->float('old_price');
            $table->float('new_price');
            $table->integer('quantity')->default(1);
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('cart_items');
    }
};
