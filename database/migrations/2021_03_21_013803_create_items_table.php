<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->datetime('expiry_at');
            $table->string('image_url')->nullable();

            // $table->foreignId('highest_bidder_id')
            //     ->nullable()
            //     ->constrained('users')
            //     ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('highest_bidder_username')->nullable();

            $table->unsignedInteger('highest_bid_price')->nullable();
            $table->unsignedInteger('initial_price')->nullable();

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
        Schema::dropIfExists('items');
    }
}
