<?php
//Model(Business) 模組，儲存變數的容器。
class Business
{
    // 載入 Data Access Layer 數據訪問 (DataAccess)
    public function DataAccess($repository)
    {
        // 如果檔案存在就引入它
        if(file_exists(WEBROOT.'/app/model/PKG/' . $package . '.php')){
            //引入 model
            require_once '../app/model/DAL/' . $repository . '.php';
            //實例化 model
            return new $repository();
        } else {
            error_log("＊模組-數據訪問不存在：".$package."\n");
            print('Woops! Data access layer not exist.');
            exit();
        }
    }
    // 載入 Package(第三方軟體)(自行新增)
    public function Package($package)
    {
        // 如果檔案存在就引入它
        if(file_exists(WEBROOT.'/app/model/PKG/' . $package . '.php')){
            //引入 plugin
            require_once WEBROOT.'/app/model/PKG/' . $package . '.php';
            //實例化 plugin
            return new $package();
        } else {
            error_log("＊模組-插件不存在：".$package."\n");
            print('Woops! Package not exist.');
            exit();
        }
    }
}