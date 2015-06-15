<?php
App::uses('AppController', 'Controller');
 
class BlocksController extends AppController {
    var $components = array("RequestHandler");

    public function index() {

      
    }

    public function detail($height) {
      $dbBlockData = $this->Block->find('all',array(
		'conditions' => array('Block.block_hash' => $height),
		'limit' => 1
	  ));
	  $this->set("dbBlockData",$dbBlockData);

	  if($dbBlockData == null){
	      $dbBlockData = $this->Block->find('all',array(
			'conditions' => array('Block.height' => $height),
			'limit' => 1
		  ));
		  if($dbBlockData['0']['Block']['id'] == $height){
	 	  	$this->set("dbBlockData",$dbBlockData);
		  } else {
			throw new NotFoundException(); //404error
		  }
	  }
	  $nextBlockData = $this->Block->findById($dbBlockData['0']['Block']['id']+1);
	  $this->set("nextBlockData",$nextBlockData);
	  $prevBlockData = $this->Block->findById($dbBlockData['0']['Block']['id']-1);
	  $this->set("prevBlockData",$prevBlockData);
    }

    public function getblockdetaildata($hash) {
      $autoLayout = false;
      if($BlockData = @file_get_contents("http://160.16.76.211:3000/api/block/".$hash)){
	    $this->set("BlockData",$BlockData);
	  } else {
	  	$this->set("BlockData","error");
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

    public function add() {
      //$this->autoRender=false;
      $dbBlockData = $this->Block->find('first',array(
        'order' => array('Block.height' => 'desc'),
      ));
      $this->set("dbBlockData",$dbBlockData);
      if($blockData = @file_get_contents("http://160.16.76.211:3000/api/block/".$dbBlockData['Block']['block_hash'])){
        $BlockData = json_decode($blockData,true);
        if($nextBlockData = @file_get_contents("http://160.16.76.211:3000/api/block/".$BlockData['nextblockhash'])){
          $nextBlockData = json_decode($nextBlockData,true);

          if(array_key_exists('nextblockhash',$BlockData)){
            $new_blockData = array(
              'Block' => array(
                'height' => $nextBlockData['height'],
                'block_hash' => $nextBlockData['hash'],
                'difficulty' => $nextBlockData['difficulty'],
                'size' => $nextBlockData['size'],
                'tx_count' => count($nextBlockData['tx']),
                'time' => date('Y-m-d H:i:s',$nextBlockData['time']),
              )
            );
            $this->set("jsonData",$nextBlockData);
            $this->Block->save($new_blockData) or die('{"error":"failed_save_address"}');
          } elseif($BlockData['isMainChain'] <> 1){
            if($previousBlockData = @file_get_contents("http://160.16.76.211:3000/api/block/".$BlockData['previousblockhash'])){
              $previousBlockData = json_decode($previousBlockData,true);
              if($rightBlockData = @file_get_contents("http://160.16.76.211:3000/api/block/".$previousBlockData['nextblockhash'])){
                $rightBlockData = json_decode($rightBlockData,true);
                $right_blockData = array(
                  'Block' => array(
                    'id' => $dbBlockData['Block']['id'],
                    'height' => $rightBlockData['height'],
                    'block_hash' => $rightBlockData['hash'],
                    'difficulty' => $rightBlockData['difficulty'],
                    'size' => $rightBlockData['size'],
                    'tx_count' => count($rightBlockData['tx']),
                    'time' => date('Y-m-d H:i:s',$rightBlockData['time']),
                  )
                );
                $this->set("jsonData",$rightBlockData);
                $this->Block->save($right_blockData) or die('{"error":"failed_save_address"}');
              }
            }
          } else {
            $this->set("jsonData","error4");
          }
        } else {
          $this->set("jsonData","error2");
        }
      } else {
        $this->set("jsonData","error");
      }
      
    }
 
}