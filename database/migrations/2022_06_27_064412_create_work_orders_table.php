<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_nr')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('equipmentissue_id');
            $table->string('priority');
            $table->integer('department_no')->nullable();
            $table->longText('description')->nullable();
            $table->longText('scope_of_work')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('client_id');
            $table->longText('address');
            $table->timestamp('orderdate');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('status')->length(4);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade') 
                ->onDelete('cascade');
                
            $table->foreign('staff_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade') 
                ->onDelete('cascade');

            $table->foreign('client_id')
                ->references('id')
                ->on('inventories')
                ->onUpdate('cascade') 
                ->onDelete('cascade');
        });
        
        //then set autoincrement to 1000
        
        //after creating the table
        
        DB::update("ALTER TABLE work_orders AUTO_INCREMENT = 10000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}
