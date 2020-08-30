<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('invoices', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        // Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('invoice_number');
            $table->string('order_number')->nullable();
            $table->string('status')->default('unpaid');
            $table->dateTime('invoiced_at');
            $table->dateTime('due_at');
            $table->double('amount', 15, 4);
            // $table->integer('category_id')->default(1);
            $table->integer('client_id');
            $table->text('notes')->nullable();
            // $table->integer('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['invoice_number', 'deleted_at']);
        });

        Schema::create('invoice_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('invoice_id')->unique();
            $table->string('status');
            $table->boolean('notify');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('invoice_id')->unique();
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
        // Schema::dropIfExists('invoices');
        Schema::drop('invoices');
        Schema::drop('invoice_histories');
        Schema::drop('invoice_items');
    }
}
