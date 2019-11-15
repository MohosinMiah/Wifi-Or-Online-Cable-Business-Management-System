<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->dateTime('reg_date');      
            $table->string('id_card',255);
            $table->string('phone',20);
            $table->text('address',255);
            $table->integer('wifi_plan');
            $table->float('monthly_bill', 8, 2);	
            $table->string('payment_method',50);
            $table->string('email',150)->nullable();
            $table->string('agent_name',100)->nullable();
            $table->text('bill_address',255)->nullable();
            $table->integer('router_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
