<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_users', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('username');

            $table->boolean('auto_bid');

            $table->timestamps();

            $table->unique(['item_id', 'username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_users');
    }
}
