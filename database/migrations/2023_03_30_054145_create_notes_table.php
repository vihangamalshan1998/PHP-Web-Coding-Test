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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->enum('current_status', ['Open', 'Closed', 'In Progress', 'On Hold', 'Cancelled'])->default('In Progress');
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade'); //related to which ticket
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade'); //who added this record
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
        Schema::dropIfExists('notes');
    }
};
