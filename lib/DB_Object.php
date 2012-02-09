<?php 

	class DB_Object {

		static $table_sufix ;
		static $table_name ; 
		static $fields ;

		static $belongs_to ;
		static $has_many ; 

		private $creation_parameters ;
		

		static function table_name(){
			global $wpdb ;
			return $wpdb->prefix . static::$table_sufix ;
		}

		static function unique_field(){
			$field = "id";
			foreach (static::$fields as $field_name => $field_options) {
				if(isset($field_options['unique'])){
					$field = $field_name ; break ;
				}
			}
			return $field ;
		}

		static function unique_field_where_clausule(){
			$field = static::unique_field();
			return  $field == 'id' ? $clausule = "id = %d" : $clausule = "$field = %s" ; 
		}

		static function build_database(){
			global $wpdb ;
			
			require_once ABSPATH . 'wp-admin/includes/upgrade.php' ;

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
			);", static::table_name(), implode(","."\n", $field_definitions), implode(","."\n", $key_definitions)) ;
			print $sql ; 
			dbDelta($sql) ;
			 		
		}

		function __construct($values, $save = true){
			$this->creation_parameters = $values ; 			 
			if($save === true){
				$this->persist();
			} else {
				foreach ($this->creation_parameters as $k => $v) {
					$this->$k = $v ; 			
				}		
			}
		}

		static public function find_or_create($args){
			global $wpdb ;
			$clausule = static::unique_field_where_clausule() ;
			if( is_array($args)){
				$param = $args[static::unique_field()] ;
			} else {
				$param = $args ; 
			}
			$sql = $wpdb->prepare(
				"select * from ".static::table_name()." where $clausule", $param) ;
			$obj = $wpdb->get_row($sql, ARRAY_A) ;
			
			if($obj){
				return new static($obj, false) ;
			} else {
				return new static($args) ;
			}
		}

		public function persist(){
			global $wpdb ;
			$fields = array();

			foreach (static::$fields as $field_name => $field_options) {
				
				if(isset($field_options['mechanized'])){
					$this->creation_parameters[$field_name] =  call_user_func($field_options['mechanized'][0], $field_options['mechanized'][1]);
				}
				$value = isset($this->$field_name) ? $this->$field_name : $this->creation_parameters[$field_name] ; 
				$fields[$field_name] =  $value; 
				$this->$field_name = $value ;
			}
			if(! isset($this->id)){
				$wpdb->insert(static::table_name(), $fields) ;
				$this->id = $wpdb->insert_id ; 
			} else {
				$wpdb->update(static::table_name(), $fields, array('id' => $this->id)) ;
			}
		}
		
	}

?>