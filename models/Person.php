<?php 
	namespace FCN ;
	use DB_Object ;
	class Person extends DB_Object {

		static $table_sufix = 'fcn_people' ;

		static $fields = array(
			'name' => array('required' => true,  'size' => 255) ,
			'email' => array('required' => true,  'unique' => true, 'size' => 255),
			'phone' => array('size' => 50), 
			'mobile' => array('size' => 50),
			'registered_in' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s')),
			'gender' => array('type' => 'enum', 'values' => array('F','M')),
			'birthdate' => array('type' => 'date'),
			'born_in_city' => array('size' => 100),
			'born_in_state' => array('size' => 2),
			'rg' => array('size' => 15),
			'cpf' => array('size' => 16),
			'address_street' => array(),
			'address_number' => array('size' => 8),
			'address_complement' => array('size' => 10),
			'address_district' => array(),
			'address_city' => array(),
			'address_state' => array('size' => 2)

		) ;

		static $has_many = 'waitee' ;
		public $name, $email, $phone, $id, $registered_in ; 
		
	}

?>