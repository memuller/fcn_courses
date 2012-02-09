<?php 
	namespace FCN ;
	use DB_Object ;
	class Waitee extends DB_Object {

		static $table_sufix = 'fcn_waitee' ;

		static $fields = array(
			'active' => array('required' => true,  'type' => 'boolean', 'default' => 1) ,
			'course_id' => array('required' => true),
			'opted_in' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s'))
		) ;

		static $belongs_to = 'person' ;
		public $name, $email, $phone, $id, $registered_in, $active, $opted_in, $course_id ; 
		
	}

?>