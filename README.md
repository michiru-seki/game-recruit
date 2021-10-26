# docker立ち上げ
## プロジェクトをクローン
git clone リポジトリURL

## コンテナをビルドと立ち上げ（一回のみ）
docker-compose build

## コンテナ立ち上げ
docker-compose up -d

## コンテナ内に入る
### WEBサーバー
docker-compose exec app bash

### データベース
docker-compose exec db bash