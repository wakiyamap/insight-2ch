<?php
App::uses('AppController', 'Controller');
 
class BlocksController extends AppController {
    var $components = array("RequestHandler");

    public function index() {

      
    }

    public function getblockdata() {
      $autoLayout = false;
      $dbBlockData = $this->Block->find('all',array(
        'order' => array('Block.height' => 'desc'),
        'limit' => 6, 
      ));
      $this->set("dbBlockData",$dbBlockData);

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
          $this->Block->save($new_blockData) or die('{"error":"failed_save_address"}');

          $this->set("jsonData",$nextBlockData);
        } else {
          $this->set("jsonData","error2");
        }
      } else {
        $this->set("jsonData","error");
      }
      
    }
 
}