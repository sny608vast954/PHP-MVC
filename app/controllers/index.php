<?php

Class index extends Controller
{
    private $headerData = array();

    public function __construct(){
        //初始化模組
        //範例：$Name = $this->Business('NameBLL');
    }
    //初始化網頁
    public function index(){
        //使用：$this->Name->function('傳入參數');
        $data = array("pageName" => "首頁");
        $this->view('inc/header',$data);
        $this->view('index');
        $this->view('inc/footer');
    }
}