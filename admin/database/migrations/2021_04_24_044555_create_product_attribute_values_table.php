<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_product_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->text('text_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->decimal('float_value')->nullable();
            $table->datetime('datetime_value')->nullable();
            $table->date('date_value')->nullable();
            $table->text('json_value')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();

			$table->foreign('parent_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_values');
    }
}
