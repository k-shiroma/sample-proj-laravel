<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('corporation_site_url', 100)->nullable();
            $table->string('support_tel1', 5)->nullable();
            $table->string('support_tel2', 5)->nullable();
            $table->string('support_tel3', 5)->nullable();
            $table->string('support_email', 256)->nullable();
            
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
        Schema::dropIfExists('corporations');
    }
}
