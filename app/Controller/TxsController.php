<?php
App::uses('AppController', 'Controller');
 
class TxsController extends AppController {
    var $components = array("RequestHandler");

    public function index() {

      
    }

    public function detail($txid) {
      if($TxData = @file_get_contents("http://160.16.76.211:3000/api/tx/".$txid)){
	    $this->set("TxData",$TxData);
	  } else {
	  	$this->set("TxData","error");
	  }
    }

    public function gettxdetaildata($txid) {
      $autoLayout = false;
      if($TxData = @file_get_contents("http://160.16.76.211:3000/api/tx/".$txid)){
	    $this->set("TxData",$TxData);
	  } else {
	  	$this->set("TxData","error");
	  }
    }

    public function getblockdata() {
      $autoLayout = false;
      $dbBlockData = $this->Block->find('all',array(
        'order' => array('Block.height' => 'desc'),
        'limit' => 6, 
      ));
      $dbBlockData = array_reverse($dbBlockData);
      $this->viewClass = 'Json';
      $this->set(compact('dbBlockData'));
      $this->set('_serialize','dbBlockData');

    }
}