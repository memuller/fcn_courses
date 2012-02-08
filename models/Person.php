<?php 
	namespace FCN ;

	class Person {

		static $table_sufix = 'fcn_people' ;
		static $table_name ; 
		static $fields = array(
			'name' => array('required' => true,  'size' => 255) ,
			'email' => array('required' => true,  'unique' => true, 'size' => 255),
			'phone' => array('size' => 50), 
			'registered_in' => array('required' => true, 'type' => 'datetime', 'mechanized' => array('date', 'Y-m-d H:i:s'))
		) ;

		static $belongs_to ;
		static $has_many ; 

		public $name, $email, $phone, $id, $registered_in ; 

		static function get_table_name(){
			global $wpdb ;
			if(!isset(static::$table_name)){
				static::$table_name = $wpdb->prefix . static::$table_sufix ;
			}
		}

		static function build_database(){
			global $wpdb ;
			
			require_once ABSPATH . 'wp-admin/includes/upgrade.php' ;
			static::get_table_name();

			$field_definitions = array() ;
			$field_definitions[]= "id bigint(20) unsigned not null auto_increment" ;
			$key_definitions = array() ;
			$key_definitions[] = "primary key id (id)" ;

			foreach (static::$fields as $field_name => $field_options) {
				if( !isset($field_options['size'])) $field_options['size'] = 255 ;
				
				if( !isset($field_options['type'])){
					$field_type = "varchar(".$field_options['size'].")" ;
				} else {
					$field_type = $field_options['type'] ;
				}

				$required = $field_options['required'] ? "not null" : "null" ;
				$field_definitions[]= "$field_name $field_type $required" ;

				if($field_options['unique']){
					$key_definitions[]= "unique key $field_name ($field_name)" ; 
				}
			}
			$sql = sprintf("CREATE TABLE %s (
				%s ,
				%s
			);", self::$table_name, implode(","."\n", $field_definitions), implode(","."\n", $key_definitions)) ;

			dbDelta($sql) ;
			 		
		}

		function __construct($values, $save = true){			 
			
			global $wpdb ; static::get_table_name();
			if($save === true){
				$fields = array();

				foreach (static::$fields as $field_name => $field_options) {
					
					if(isset($field_options['mechanized'])){
						$values[$field_name] =  call_user_func($field_options['mechanized'][0], $field_options['mechanized'][1]);
					}

					$fields[$field_name] = $values[$field_name] ; $this->$field_name = $values[$field_name] ;
				}

				$wpdb->insert(static::$table_name, $fields) ;
				$this->id = $wpdb->insert_id ; 
			} else {
				foreach ($values as $k => $v) {
					$this->$k = $v ; 			
				}		
			}
		}
		
	}

?>