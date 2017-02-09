<?php

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
            $table->increments('id');
            $table->integer('corporation_id');
            $table->string('name', 50);
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->dateTime('sales_start_dt')->nullable();
            $table->dateTime('sales_end_dt')->nullable();
            
            $table->integer('created_user_id');
            $table->integer('update_user_id');
            $table->timestamps(); // 作成日付(created_at), 更新日付(updated_at) 追加
            $table->softDeletes(); // 論理削除(delete_at:timestamp型) 追加
        });
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
