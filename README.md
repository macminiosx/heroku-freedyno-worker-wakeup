Heroku Free Dyno Worker Wake Up
=============

HerokuのFree Dynoでworkerを運用していたが、2015/07/01から起動後30分で'idle'状態になる。  
そこでぶつ切れ状態だがHeroku APIでDynoの'state'を監視して'idle'になったらリスタートをかけるスクリプトを書いた。  
これをcronで1分毎実行させる。

## スクリプト

worker_wakeup.pl : perlスクリプト  
worker_wakeup.php: phpスクリプト  


## 設定

$appにapp_name  
$tokenにHeroku API Token  
取得は  

$ heroku auth:token  

$dyno_nameには'worker'か'bot'  
