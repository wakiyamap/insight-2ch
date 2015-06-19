<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class Tx extends AppModel {
	var $uses = null;
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'block';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		//'height' => array(
			//'numeric' => array(
				//'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
		//'block_hash' => array(
			//'notEmpty' => array(
				//'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
	);
}
