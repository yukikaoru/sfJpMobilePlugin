# sfJpMobilePlugin: 携帯サイト作成支援のsymfony用プラグイン

## こんなもの

symfonyで携帯サイトを作った際に作ったものをプラグインとして抜き出したもの。
自分の仕事で利用しているので、下位機種はもとより、中位機種の対応すら考慮されてません。
キャリア判別にはファイアーウォール側でIP判別を行っているので、IPによる判別機能はもっていません。

IPによる判別を行いたいのであれば、sfMobileIPPluginを利用したほうがいいかなと思います。

## 使えるらしい機能

* UserAgentによるキャリア判別
* 端末IDの取得
* 契約者番号の取得
* セッションへの対応
* 絵文字の相互変換
* テンプレートの自動振り分け
* 機種毎のデータを使うためのモデル

## 設置方法

### 利用するコントローラの変更

    #config/factories.yml
    all:
      controlelr:
        class: sfJpMobileController

### フィルタの追加

    # config/filters.yml
    jpmobile:
      class: sfJpMobileFilter

### ビュークラスの変更

    #config/app.yml
    all:
      view:
        class: sfJpMobile

### ヘルパーの追加

    #config/factories.yml
    all:
      .settings:
        standard_helpers:       [Partial, Cache, Form, JpMobile]

### レイアウトの変更

自分で宣言してもいいけど、一応DOCTYPEの切り替えパーシャルをプリセットしてある。

apps/\*/templates/layout.phpのDOCTYPE宣言のところをごっそり変更
    <code php>
      <?php include_partial('jpmobile/dtd') ?>
    </code>

### セッションの利用

    #config/factories.yml
    all:
      storage:
        class: sfJpMobileSessionStorage
        param:
          session_name: symfony   # ここはお好きな名前で

## テンプレートの振り分けについて

下記の様にテンプレートファイル名を付けることで、振り分けることが可能です。

* 通常:     indexSuccess.php
* 携帯共通: indexSuccessMobile.php
* docomo:   indexSuccessDocomo.php
* au:       indexSuccessAu.php
* SoftBank: indexSuccessSoftbank.php
* その他:   indexSuccessOther.php

DoCoMoでアクセスした場合、xxxDocomo -> xxxMobile -> 通常 の順でテンプレートを探します。

### 副作用

レイアウトも同様に振り分けられちゃいます。

