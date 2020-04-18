<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('permission', function ($table) {
            $table->increments('id');
            $table->string('permissionname',20)->notNull();//权限名称
            $table->string('controller',40)->nullable();//权限对应的方法
            $table->string('action',30) -> nullable();//权限对应的方法
            $table->tinyInteger('pid');//当前权限父级id
            $table->timestamps();
            $table->enum('is_nav',[1,2]) -> notNull() -> default('1');//是否作为菜单提示

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
        Schema::dropIfExists('permission');
    }
}
