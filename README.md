# sample-proj-laravel
Laravel サンプル実装

---

## 環境
| 機能 | 名称 | バージョン | 備考 |
| --- | --- | --- | --- |
|OS|Windows|7||
|仮想環境|VirtualBox|5.1.14-112924|xampp php5.6.28(xamppはcomposerインストールする為phpのみ使用)|
|仮想環境管理|vagrant|1.9.1||
|Git|Git for Windows|2.11.0.3||
|EDI|eclipse|Windows 64bit Full version||
|リモートログオン|PuTTY|0.67||
|仮想開発環境|Laravel Homestead|1.0.1||
|依存管理|Composer|1.3.1||
|||||

---

## 環境構築(共通)
### VirtualBox
#### インストール
1. [VirtualBox-5.1.14-112924-Win.exe]取得、実行
1. デフォルトインストールでOK

### vagrant
#### インストール
1. [vagrant_1.9.1.msi]取得、実行
1. デフォルトインストールでOK
  ※PC再起動が必要

### Git for Windows
#### インストール
1. [Git-2.11.0.3-64-bit.exe]取得、実行
1. [Adjusting your PATH environment]画面  
   [Use Git from the Windows Command Prompt]チェックON
1. [Configuring the line ending conversions]画面  
   [Checkout as-is, commit as-is]チェックON
1. [Configuring the terminal emulator to use with Git Bash]画面  
   [Use MinTTY(the default terminal of MSYS2)]チェックON
1. [Configuring extra options]画面  
   [Enable file system caching]選択  
   [Enable Git Credential Manager]選択

### eclipse
#### インストール
1. [pleiades-4.6.2-php-win-64bit-jre_20161221.zip]取得、[c:\sample]に解凍
1. [c:\sample\pleiades\]となっていればOK

### PuTTY
#### インストール
1. [putty-0.67-jp20160306.zip]取得、解凍し任意の場所に配置

#### キー作成
1. [解凍したフォルダ]/puttygen.exe 実行
1. [Generate]
1. マウスをぐりんぐりん動かす
1. [Key passphrase],[Confirm passphrase]に任意のパスワードを入力 > [Save public key] > デスクトップに[id_rsa.pub]で保存 > [Save private key] > デスクトップに[id_rsa]で保存  
  ※後で配置します

### Laravel Homestead
Laravel + Vagrant + VirtualBox の仮想開発環境を提供します。

#### 設定
1. cmd起動
1. box を vagrant に設定(10分程度かかります)
  ※どのboxを使用するか聞かれるので [2) virtualbox] を選択 (2 入力 -> Enter)
  
  ```
  cd c:\sample
  vagrant box add laravel/homestead
  ```

1. Homestead 取得

  ```
  git clone https://github.com/laravel/homestead.git Homestead
  ```

1. Homestead 初期化

  ```
  cd Homestead
  init.bat
  ```

1. Homestead.yaml 設定 (デフォルトでもOKだが解説)  
  C:\Users\[ユーザ名]\.homestead\Homestead.yaml
  
  ```
  authorize: ~/.ssh/id_rsa.pub

  keys:
      - ~/.ssh/id_rsa

  folders:
      #- map: ~/Code
      #  to: /home/vagrant/Code
      - map: /sample/Code
        to: /home/vagrant/Code

  sites:
      #- map: homestead.app
      #  to: /home/vagrant/Code/Laravel/public
      - map: sample-proj.app
        to: /home/vagrant/Code/sample-proj-laravel/public
  ```

  1. folders  
     フォルダマッピング設定。Homestead の仮想OS（ubuntu）のフォルダと Windows 上のフォルダのペアを指定して、２つの環境から同じフォルダを参照できるようにします。  
   上の例ではWindowsの「C:\Users\ユーザー名\Code」というフォルダと仮想OSの「/home/vagrant/Code」フォルダが同じフォルダであるかのように振る舞います。
    1. map：Windows 側のフォルダ
    1. to：仮想OS側のフォルダ
  1. sites  
     ローカルドメインとフォルダのマッピング設定。  
     ブラウザで「http://homestead.app」と入力すると「/home/vagrant/Code/Laravel/public」というフォルダの内容が表示されるようになります。
1. キー配置
  1. フォルダ作成(cmd起動し下記実行)
  
    ```
    cd C:\Users\[ユーザ名]\
    mkdir .ssh
    ```

  1. PuTTYで作成したキーを[.ssh]フォルダに移動
1. 仮想VM起動
  1. cmdで下記実行

    ```
    cd c:\sample\Homestead
    vagrant up
    ```

1. 仮想VM起動確認
  runningになっていればOK
  
  ```
  vagrant status
  ```
  
1. PuTTY で接続
  - IP: 192.168.10.10
  - ID: vagrant
  - PW: vagrant  
    ※rootユーザのパスワードは不明だが、[sudo su]でrootになれる

## 環境構築(プロジェクト新規作成時)
1. PuTTY で接続
1. プロジェクト作成

  ```
  cd Code
  composer create-project laravel/laravel sample-proj-laravel --prefer-dist
  ```

1. .envファイル(各環境毎のDB接続情報等設定ファイル)設定
  1. .env作成、アプリケーション固有情報設定
  
    ```
    cd sample-proj-laravel
    cp .env.example .env
    php artisan key:generate
    ```
  
  1. DB情報等修正
  
    ```
    DB_DATABASE=sample_proj_db
    DB_USERNAME=sample_proj_user
    DB_PASSWORD=password
    ```
  
1. タイムゾーン/言語設定
  1. [プロジェクトルート]\config\app.php を開き、下記に修正
  
    ```
    'timezone' => 'Asia/Tokyo',
    'locale' => 'ja',
    ```

1. 環境反映
  1. cmdから下記実行
  
    ```
    cd c:\sample\Homestead
    vagrant provision
    ```

1. http://homestead.app または http://192.168.10.10 に接続し動作確認

---

## 環境構築(gitからプロジェクト取得時)
1. プロジェクトのライブラリ取得
   vandorフォルダに各ライブラリが入る(リポジトリにvandorがあったらignoreする)

	```
	$ composer install
	```

1. .evn設定
  1. サンプルからコピー

	  ```
	  $ cp .env.example .env
	  ```

  1. .envファイルを開き環境に合わせて修正
  1. アプリケーションキー初期化

	  ```
	  cd ~/Code/sample-proj-laravel
	  php artisan key:generate
	  ```

  1. DB作成、データ投入

  	```
  	php artisan migrate
  	php artisan db:seed
  	```

- 参考URL
	- http://vdeep.net/laravel-git-clone


<!--

1. DB、ユーザ作成、接続確認
     
  ```
  sudo su
  mysql
  mysql> CREATE DATABASE sample_proj_db CHARACTER SET utf8;
  mysql> GRANT ALL PRIVILEGES ON sample_proj_db.* TO sample_proj_user@localhost IDENTIFIED BY 'password' WITH GRANT OPTION;
  mysql> \q
  su vagrant
  mysql -u sample_proj_user -ppassword
  mysql> use sample_proj_db
  mysql> \q
  ```

-->
