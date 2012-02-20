<?php 
	namespace FCN ;
	use DB_Object ;
	class Person extends DB_Object {

		static $table_sufix = 'fcn_people' ;

		static $fields = array(
			'name' => array('required' => true,  'size' => 255) ,
			'email' => array('required' => true,  'unique' => true, 'size' => 255),
			'phone' => array('size' => 50), 
			'registered_in' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s')),
			'gender' => array('type' => 'enum', 'values' => array('F','M'))
		) ;

		static $has_many = 'waitee' ;
		public $name, $email, $phone, $id, $registered_in ; 
		
	}

?>