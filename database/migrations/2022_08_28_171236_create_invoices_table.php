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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreignId('season_id')->references('id')->on('season');
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('remained_amount', 10, 2)->default(0.00);
            $table->decimal('percent_discount', 8, 2)->nullable();
            $table->decimal('fixed_discount', 8, 2)->default(0.00);
            $table->decimal('ton_price')->default(0.00);
            $table->date('date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('picked_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('invoices');
    }
};
