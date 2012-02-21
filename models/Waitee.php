<?php 
	namespace FCN ;
	use DB_Object ;

	class Waitee extends DB_Object {

		static $table_sufix = 'fcn_waitees' ;

		static $fields = array(
			'active' => array('required' => true,  'type' => 'boolean', 'default' => 1) ,
			'course_id' => array('required' => true, 'type' => 'bigint(20) unsigned'),
			'opted_in' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s'))
		) ;

		static $compound_indexes = array(
			'unique' => array('person_id', 'course_id')
		);

		static $belongs_to = 'person' ; 
		public $id, $active, $opted_in, $course_id ; 
		
	}

?>