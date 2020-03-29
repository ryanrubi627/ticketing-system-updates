<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosedTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code');
            $table->string('name');
            $table->string('title');
            $table->string('description');
            $table->string('importance');
            $table->string('date');
            $table->string('status');
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
        Schema::dropIfExists('closed_tickets');
    }
}
