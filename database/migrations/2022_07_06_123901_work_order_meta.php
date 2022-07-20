<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WorkOrderMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('woid');
            $table->unsignedBigInteger('job_performed_by')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->default(null);
            $table->longText('remarks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('job_performed_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade') 
                ->onDelete('cascade');
            
            $table->foreign('woid')
                ->references('id')
                ->on('work_orders')
                ->onUpdate('cascade') 
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
        //
    }
}
