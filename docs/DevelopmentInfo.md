# 実装手順

---

## 略
- [プロジェクトルート] : ~/Code/sample-proj-laravel　または c:\sample\Code\sample-proj-laravel

## プロジェクト構成

- [プロジェクトルート]
-- app
--- Models : [プロジェクト独自] モデルを配置
--- Services : [プロジェクト独自] サービスを配置
-- databalse : DB関連
--- migrations : マイグレーションファイルを配置
--- seeds : シーダークラス(DB初期データ生成コード)を配置
-- docs : [プロジェクト独自] ドキュメントを配置。
-- routes : ルーティング設定
--- api.php : WebAPI用
--- channels.php
--- console.php
--- web.php : Web用
-- vendor : [ソース管理外] プロジェクトで使用するライブラリーを配置
- .env : [ソース管理外] DB接続情報等設定ファイル
- .env.example : DB接続情報等設定ファイルの元。ソース取得時にはこのファイルをコピーして.envを作る。

## マイグレーション(テーブル作成用コード)
### マイグレーションファイル作成
1. 下記実行

	```sh
	#php artisan make:migration create_[テーブル名(スネーク形式/複数形)]_table --create=[テーブル名(スネーク形式/複数形)]
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

## シーダー(初期データ生成)
### シーダークラス作成
1. 下記実行

    ```sh
    #php artisan make:seeder [テーブル名(Pascal/複数形)]TableSeeder
    php artisan make:seeder CorporationsTableSeeder
    ```

    - [プロジェクトルート]/database/seeds/CorporationTableSeeder.php が生成
1. 

## モデル
Laravel の O/Rマッパーは [Eloquent(エレクェント)]  

### モデル作成
1. 下記実行

    ```sh
    #php artisan make:model [モデル名(Pascal形式/単数形)]
    php artisan make:model Models/Corporation
    ```

    - [プロジェクトルート]/app/Models/Corporation が生成
    - テーブルとモデルの紐付けは基本的に命名規約
1. モデルを開き、リレーション設定

    ```php
    class Corporation extends Model
    {
        /**
         * 商品モデルを取得.
         * 会社(corporations)と商品(products)が1:Nで紐付く
         */
        public function products()
        {
            // 子(1件)を取得する場合は hasOne
            // 子(n件)を取得する場合は　hasMany
            // 親を取得する場合は belongsTo
            return $this->hasMany('App\Models\Product');
        }
    }
    ```

## ルーティング
1. [プロジェクトルート]/routes/web.php を開く
1. 下記追記

    ```php
    // 会社
    // Route::[HTTPメソッド]([URL], [コントローラー名@メソッド名]);
    Route::get('/corporation/create','CorporationController@showCreate');   // 登録
    Route::post('/corporation/create','CorporationController@create');      // 登録実行
    Route::get('/corporation/{id}','CorporationController@showEdit');       // 変更
    Route::patch('/corporation/{id}','CorporationController@edit');         // 変更実行
    Route::delete('/corporation/{id}','CorporationController@delete');      // 削除実行
    Route::get('/corporation','CorporationController@index');               // 一覧

    Route::get('/', function () {
        return view('welcome');
    });
    ```

## コントローラー
1. 下記実行

    ```sh
    #php artisan make:controller [コントローラー名(Pascal形式/単数形)]
    php artisan make:controller CorporationController 
    ```

1. [プロジェクトルート]/app/Http/Controllers/Corporation を開き、下記追記

    ```php
    public function index()
    {
        $corporations = Corporation::all();
        // 下記の場合、/resources/views/corporations/index.blade.php が呼ばれ、ビューに $corporations 変数を corporations でバインドする
        return view('corporations.index')->with('corporations', $corporations);
    }
    ```

## ビュー 
テンプレートエンジンとして blade(ブレード) を使用

1. [プロジェクトルート]/resources/views/corporations/index.blade.php を作成し下記記述

    ```php
    <p>会社一覧</p>
    <hr>
    <table>
        <tr>
            <td>ID</td>
            <td>名前</td>
            <td>サイトURL</td>
            <td>サポートTel</td>
            <td>サポートメール</td>
        </tr>
    @foreach($corporations as $corporation)
        <tr>
            <td>{{ $corporation->id }}</td>
            <td>{{ $corporation->name }}</td>
            <td>{{ $corporation->corporation_site_url }}</td>
            <td>{{ $corporation->support_tel1 }}-{{ $corporation->support_tel2 }}-{{ $corporation->support_tel3 }}</td>
            <td>{{ $corporation->support_email }}</td>
        </tr>
    @endforeach
    </table>
    ```
