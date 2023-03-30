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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8);
            $table->string('customer_name', 50)->nullable();
            $table->string('mobile')->nullable();
            $table->string('email', 50)->nullable();
            $table->enum('status', ['Open', 'Closed', 'In Progress', 'On Hold', 'Cancelled'])->default('Open');
            $table->text('body');
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
        Schema::dropIfExists('tickets');
    }
};
