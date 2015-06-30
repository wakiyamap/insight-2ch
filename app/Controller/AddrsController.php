<?php
App::uses('AppController', 'Controller');
 
class AddrsController extends AppController {
    var $components = array("RequestHandler");

    public function index() {

      
    }

    public function detail($address) {
      if($AddrData = @file_get_contents("http://160.16.76.211:3000/api/addr/".$address)){
		$AddrData = json_decode($AddrData,true);
	    $this->set("AddrData",$AddrData);
	  } else {
	  	$this->set("AddrData","error");
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