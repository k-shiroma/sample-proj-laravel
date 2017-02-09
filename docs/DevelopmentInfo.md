# 実装手順

---

## 略
- [プロジェクトルート] : ~/Code/sample-proj-laravel　または c:\sample\Code\sample-proj-laravel

## マイグレーション(テーブル作成用コード)
### マイグレーションファイル作成
1. 下記実行

	```sh
	#php artisan make:migration [マイグレーションファイル名] --create=[テーブル名(スネーク形式/複数形)]
	php artisan make:migration create_corporations_table --create=corporations
	```

1. [プロジェクトルート]/database/migrations/[日付]_[マイグレーションファイル名].php を開く
1. テーブルのカラム定義 (up メソッドに追加)  
   ※$table->[型]([カラム名]) の型は下記参照  
   https://readouble.com/laravel/5.1/ja/migrations.html

	```php
    public function up()
    {
        Schema::create('corporations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
	```

### マイグレーション実行
1. 下記実行

	```sh
	cd ~/Code/sample-proj-laravel
	php artisan migrate
	```

