<?php
/*
* 將常數放置於此
*/
// Database 的參數，以下為MySQL範例：
    define('DB_HOST','127.0.0.1');
    define('DB_PORT','3306');//預設Port
    define('DB_ACCOUNT','');//你的DB帳號
    define('DB_PASSWORD','');//你的DB密碼
    define('DB_NAME','');//資料庫名稱
    define('DB_CHARSET', 'utf8');//編碼方式（預設UTF-8）（建議使用：utf8mb4 可支援emoji）
// WEB 資料夾位置：
define('WEBROOT', '');

// URL 根目錄，這是引入 public 資料夾裡的資源，或是頁面跳轉時用的(相對協定URL)：
define('URLROOT', '//localhost/');

// 網站名稱：
define('SITENAME', '簡易MVC');

// Log事件紀錄檔：
define('LOGROOT', WEBROOT.'logs/');

?>