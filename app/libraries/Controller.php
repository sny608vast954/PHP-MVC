<?php

class Controller
{
    // 載入 Business Logic Layer 商業邏輯 (Business)
    public function Business($business)
    {
        // 如果檔案存在就引入它
        if(file_exists(WEBROOT.'/app/model/BLL/'. $business . '.php')){
            //引入 business
            require_once WEBROOT.'/app/model/BLL/'. $business . '.php';
            //實例化 business
            return new $business();
        } else {
            error_log("＊模組-業務邏輯不存在：".$business."\n");
            print('Woops! Business logic not exist.');
            exit();
        }
    }
    // 載入 view：其中 view 可能有需要從 Controller 帶過去的資料，故多了 $data 陣列作為第二個參數
    public function view($view, array $data = [])
    {
        // 如果檔案存在就引入它
        if(file_exists(WEBROOT.'/app/view/' . $view . '.php')){
            require_once WEBROOT.'/app/view/' . $view . '.php';
        } else {
            error_log("＊視圖不存在：".$view."\n");
            print('Woops! View not exist.');
            exit();
        }
    }
}