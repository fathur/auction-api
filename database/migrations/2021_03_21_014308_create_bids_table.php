<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedInteger('nominal');

            $table->foreignId('bidder_id')
                ->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();

            $table->unique([
                'item_id',
                'nominal',
                'bidder_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
