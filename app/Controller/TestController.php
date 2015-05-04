<?php
App::uses('AppController', 'Controller');
 
class TestController extends AppController {
    var $components = array("RequestHandler");

    public function index() {
        echo "<html><head></head><body>";
        echo "<h1>サンプルページ</h1>";
        echo "<p>これがサンプルのページです。</p>";
        echo "</body></html>";
    }
 
}