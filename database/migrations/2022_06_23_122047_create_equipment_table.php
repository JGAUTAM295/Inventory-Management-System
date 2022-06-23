<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('inventory_id');
            $table->string('name');
            $table->string('type');
            $table->string('asset');
            $table->string('asset_tag');
            $table->string('site');
            $table->string('aaa_location');
            $table->string('location');
            $table->string('assets_type');
            $table->string('assets_description_maximo');
            $table->string('assets_description');
            $table->string('parent_of_assets_clarification');
            $table->string('assets_class');
            $table->string('vendor_supplier');
            $table->string('manufacturer');
            $table->string('year_made');
            $table->string('model');
            $table->string('serial');
            $table->string('cost');
            $table->string('installation_date');
            $table->string('expected_life_year');
            $table->string('subcontractor');
            $table->tinyInteger('status')->length(4);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
