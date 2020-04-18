<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('negotiation', function ($table) {
            $table->increments('id');
            $table->tinyInteger('info_id');//用户名称
            $table->tinyInteger('emp_id');//用户名称
            $table->enum('currency',[1,2,3])->notNull()-> default('1');//签约货币种类
            $table->string('investment',20)->notNull();//投资金额
            $table->dateTime('neg_at')->notNull();//签约时间
            $table->string('remark',500)->nullable();//签约说明
            $table->string('contract_file',50) -> notNull();//合同上传
            $table->tinyInteger('flow_no',20)->notNull();//流程编号
            $table->tinyInteger('current_node',20)->notNull();//当前节点编号
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
        //
        Schema::dropIfExists('negotiation');
    }
}
