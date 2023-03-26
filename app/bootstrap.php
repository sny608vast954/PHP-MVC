<?php
//載入全域變數
require_once 'config/config.php';
//自動加載：當未定義的類或接口被使用時，腳本引擎會在出錯前通過自動加載器來加載所需要的類。
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});