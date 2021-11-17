# Game Recruit
ゲーム用のマッチングサービス

## サービス概要
* 簡単にゲーム仲間を集めることができるサービス
* 各ゲームそれぞれでのチームをの作成
* チームメンバーの募集
* チーム内チャット
* チームメンバーとの個人チャット

## docker立ち上げ
* プロジェクトをクローン

`git clone リポジトリURL`

* コンテナをビルドと立ち上げ（一回のみ）

`docker-compose build`

* コンテナ立ち上げ

`docker-compose up -d`

## コンテナ内に入る

* WEBサーバー

`docker-compose exec app bash`

* データベース

`docker-compose exec db bash`

## データ作成

* テーブル作成

`php artisan migrate`


* 初期データ作成 (ログイン用のユーザーも作成される ユーザー名：admin パスワード：password)

`php artisan db:seed`

* ログイン用のユーザーに紐づく友だちを5人作成

`docker-compose exec app bash`

`php artisan tinker`

`use App\Models\Friend;`

`Friend::factory()->count(5)->create();`

* ログイン用のユーザーに紐づくグループを2つ作成

`docker-compose exec app bash`

`php artisan tinker`

`use App\Models\GroupMember;`

`GroupMember::factory()->count(2)->create();`
