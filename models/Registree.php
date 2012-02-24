<?php 
	namespace FCN ;
	use DB_Object ;

	class Registree extends DB_Object {

		static $table_sufix = 'fcn_registree' ;

		static $fields = array(
			'status' => array('required' => true, 'default' => 'pending', 'type' => 'enum', 'values' => array('validating','pending','valid','invalid'), 'index' => true) ,
			'class_id' => array('required' => true, 'type' => 'bigint(20) unsigned'),
			'signed_up' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s')),
			'paid_up' => array('type' => 'datetime' ),
			'payment_receipt' => array('type' => 'text') ,
			'pays' => array('type' => 'tinyint(1)', 'required' => true ,'default' => 1)
		) ;

		static $compound_indexes = array(
			'unique' => array('person_id', 'class_id')
		);

		static $belongs_to = 'person' ; 
		public $id, $status, $course_id, $signed_up, $paid_up ;

		function receipt(){
			if(strpos($this->payment_receipt, 'http://') !== false){
				return "<img src='$this->payment_receipt' width='600px' >" ;
			} else {
				return $this->payment_receipt ;
			}
		}

		function payment_url(){
			$class = new Edition($this->class_id) ; $course = new Course($class->course_id) ;
			return get_permalink($course->ID) . "&payment_for=".$this->person->email ;
		}
	}

?>