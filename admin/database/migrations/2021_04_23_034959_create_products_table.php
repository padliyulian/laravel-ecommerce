<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('sku');
            $table->string('type');
            $table->string('name');
            $table->string('slug');
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('weight', 15, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->integer('status')->nullable();

            $table->foreign('parent_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE products ADD FULLTEXT search(name,slug,short_description,description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
