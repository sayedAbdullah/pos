<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Bills
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('bill_number');
            $table->string('order_number')->nullable();
            $table->string('status')->default('unpaid');
            $table->dateTime('billed_at');
            $table->dateTime('due_at');
            $table->double('amount', 15, 4);
            // $table->integer('category_id')->default(1);
            $table->integer('vendor_id');
            $table->text('notes')->nullable();
            // $table->integer('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['bill_number', 'deleted_at']);
        });

        Schema::create('bill_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('bill_id')->unique();
            $table->string('status');
            $table->boolean('notify');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('bill_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('bill_id')->unique();
            $table->integer('item_id')->nullable();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->double('quantity', 7, 2);
            $table->double('price', 15, 4);
            $table->double('total', 15, 4);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
