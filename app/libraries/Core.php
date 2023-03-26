<?php
//文章半殘
//請服用：https://stackoverflow.com/questions/65499876/php-mvc-pass-multiple-parameters
class Core
{
    // 預設 Controller 為 index
    protected $currentController = 'index';
    // 預設方法為 index
    protected $currentMethod = 'index';
    // 預設數組為空
    protected $params = array();

    //建構式
    public function __construct(){
        // 呼叫 getUrl() 取得 $url 陣列
        $url = $this->getUrl();
        // 檢查$url是否不為空，檢查 $url[0] 是否有對應的 Controller ，即是否存在 $url[0].php 的檔案
        if(!empty($url) && file_exists('../app/controllers/' .ucwords($url[0]).'.php')){
            // 將 $url[0] 首字母轉為大寫，視為 Controller 的名稱
            $this->currentController = ucwords($url[0]);
            // unset index 0(移除變量值，url剩餘元素後續將作為參數使用。)
            unset($url[0]);
            error_log('取得控制器並改寫成功。');
        }
        // 啟動Session
        session_start();
        // 引入 Controller
        require_once WEBROOT.'/app/controllers/'.$this->currentController.'.php';
        error_log('引入控制器：'.$this->currentController);
        // 實例化 Controller
        $this->currentController = new $this->currentController;
        //接著檢查$url[1]是否有值，若有，檢查該值是否有對應的方法
        if(isset($url[1])){
            //檢查方法是否存在指定的object中
            if(method_exists($this->currentController, $url[1])){
                // $url[1] 視為 Controller 中的方法
                $this->currentMethod = $url[1];
                unset($url[1]);// unset(移除變量值，url剩餘元素後續將作為參數使用。)
            }
        }
        //$url 陣列中的剩餘元素將視為帶入方法中的參數
        //如果$url不為空，則將$url數組中的值重新排列並返回，並賦值給$this->params，否則將一個空數組賦值給$this->params。
        $this->params = $url ? array_values($url) : [];
        // 最後透過呼叫 callback 來執行方法 第一個是Controller，第二個是Controller裡面的方法，第三個會把後方變數塞進一個變數中，使用時方法後面有多個變數接就沒問題。
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
        /*
        從 public?url= 後開始，將 $url 按 / 切分，轉換成陣列並回傳
        例如： 使用者輸入 127.0.0.1/public?url=posts/show/1
        則回傳 $url 的值為 ['posts', 'show', 1]
        它將在 __construct() 中依序被解析成 Controller, 方法, 參數
        */
            //從字串右側移除指定字元'/'
            //error_log('Core.getUrl得到：'.$_GET['url']);
            $url = rtrim($_GET['url'], '/');
            //過濾變數確保變數屬於URL(變數名,限URL)
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //碰到/，切割字串(符號, 字串)
            $url = explode('/', $url);
            //此時URL變成陣列
            return $url;
        }
    }
}