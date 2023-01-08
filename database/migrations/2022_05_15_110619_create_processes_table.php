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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreignId('floor_id')->references('id')->on('floors');
            $table->foreignId('warehouse_id')->references('id')->on('warehouses');
            $table->integer('number_kilo');
            $table->foreignId('product_id')->references('id')->on('products_type');
            $table->foreignId('product_type_id')->references('id')->on('types');
            $table->foreignId('sacks_type_id')->references('id')->on('sacks');
            $table->integer('sacks_number');
            $table->string('sacks_color');
            $table->enum('process_type',['insert','exit']);
            $table->string('date');
            $table->string('car_number');
            $table->foreignId('driver_id')->nullable()->references('id')->on('drivers');
            $table->string('driver_name');
            $table->string('driver_number');
            $table->foreignId('season_id')->references('id')->on('season');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('processes');
    }
};
