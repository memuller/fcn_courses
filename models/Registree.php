<?php 
	namespace FCN ;
	use DB_Object ;

	class Registree extends DB_Object {

		static $table_sufix = 'fcn_registree' ;

		static $fields = array(
			'status' => array('required' => true, 'default' => 'pending') ,
			'course_id' => array('required' => true),
			'signed_up' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s')),
			'paid_up' => array('type' => 'datetime' )
		) ;

		static $compound_indexes = array(
			'unique' => array('person_id', 'course_id')
		);

		static $belongs_to = 'person' ; 
		public $id, $status, $course_id, $signed_up, $paid_up ;
		
	}

?>