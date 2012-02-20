<?php 
	
	class DB_Object {

		static $table_sufix ;
		static $table_name ; 
		static $fields ;

		static $belongs_to ;
		static $has_many ; 

		public $new_record ; 
		private $creation_parameters ;
		
		static function get_class_name(){
			return get_called_class() ;
		}

		static function table_name(){
			global $wpdb ;
			return $wpdb->prefix . static::$table_sufix ;
		}

		static function unique_field(){

			if(isset(static::$compound_indexes)){
				return static::$compound_indexes['unique'] ;
			}

			$field = "id";
			
			foreach (static::$fields as $field_name => $field_options) {
				if(isset($field_options['unique'])){
					$field = $field_name ; break ;
				}
			}
			return $field ;
		}

		static function belongs_to_class_name(){
			$splat = explode("\\", static::get_class_name()) ; $namespace = $splat[0] ;
			return $namespace . "\\" .ucfirst(static::$belongs_to) ;
		}

		static function unique_field_where_clausule(){
			
			$field = static::unique_field();
			if(is_array($field)){
				$clausule = array(); ;
				foreach ($field as $obj) {
					$clausule[]= "$obj = %d" ; 
				}
				return implode(" AND ", $clausule) ;
			}
			
			return  $field == 'id' ? $clausule = "id = %d" : $clausule = "$field = %s" ; 
		}

		static function build_database(){
			global $wpdb ;
			
			require_once ABSPATH . 'wp-admin/includes/upgrade.php' ;

			$field_definitions = array() ;
			$field_definitions[]= "id bigint(20) unsigned not null auto_increment" ;
			$key_definitions = array() ;
			$key_definitions[] = "primary key id (id)" ;

			if (isset(static::$belongs_to)) {
				$field_definitions[]= static::$belongs_to."_id bigint(20) unsigned not null" ;
			}

			foreach (static::$fields as $field_name => $field_options) {
				if( !isset($field_options['size'])) $field_options['size'] = 255 ;
				
				if( !isset($field_options['type'])){
					$field_type = "varchar(".$field_options['size'].")" ;
				} else {
					$field_type = $field_options['type'] ;
				}

				if(isset($field_options['default'])){
					if(strstr($field_type, 'varchar')) $field_options['default'] = "'".$field_options['default']."'" ;
					$default = "default ".$field_options['default'] ;
				} else {
					$default = "" ;
				}

				$required = $field_options['required'] ? "not null" : "null" ;
				$field_definitions[]= "$field_name $field_type $default $required" ;

				if($field_options['unique']){
					$key_definitions[]= "unique key $field_name ($field_name)" ; 
				}
			}
			$sql = sprintf("CREATE TABLE %s (
				%s ,
				%s
			);", static::table_name(), implode(","."\n", $field_definitions), implode(","."\n", $key_definitions)) ;
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
				$this->new_record = false ; 
			}
		}

		static public function find_or_create($args){
			global $wpdb ;
			$clausule = static::unique_field_where_clausule() ;

			if(isset(static::$belongs_to)) {
				if(sizeof($args) == sizeof(static::unique_field())){
					$param = $args ;
				} else {
					$param = array(); $key_class = static::belongs_to_class_name() ; $key_creation_args = array();
					foreach (static::unique_field() as $field_name) {
						$param[$field_name]= $args[$field_name] ;
					}
					
					foreach($args as $field_name => $field_value){
						if(strstr($field_name, static::$belongs_to)){
							$inherited_field_name = $field_name ; $field_name = str_replace(static::$belongs_to."_", "", $field_name) ;
							$key_creation_args[$field_name]= $field_value ;
						}
					}
					$belongs_to_fk_name = static::$belongs_to . "_id" ;
					$key = $key_class::find_or_create($key_creation_args) ;
					$param[$belongs_to_fk_name] = $key->id ; 

				}
				$sql = vsprintf("select * from ".static::table_name()." where $clausule", $param) ;
			} else {
				if( is_array($args)){
					$param = $args[static::unique_field()] ;
				} else {
					$param = $args ; 
				}
				$sql = $wpdb->prepare(
					"select * from ".static::table_name()." where $clausule", $param) ;
			}	
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

			if(static::$belongs_to){
				$key_class_fields = array() ; $local_fields_from_key = array();
				$key_class = static::belongs_to_class_name() ;
				$fk_field = static::$belongs_to."_id" ;
				
				if(!isset($this->$fk_field)){

					foreach ( $key_class::$fields as $field_name => $field_options) {
						$compound_field_name = static::$belongs_to."_$field_name" ;
						$value = isset($this->$compound_field_name) ? $this->$compound_field_name : $this->creation_parameters[$compound_field_name] ;
						$key_class_fields[$field_name] = $value ;
						$this->$compound_field_name = $value ; 

					}
					$key_obj = $key_class::find_or_create($key_class_fields) ;
					if($key_obj){
						$fields[$fk_field] = $key_obj->id ; 
					}
				}

			}
			foreach (static::$fields as $field_name => $field_options) {
				
				if(isset($field_options['mechanized'])){
					$this->creation_parameters[$field_name] =  call_user_func($field_options['mechanized'][0], $field_options['mechanized'][1]);
				}
				$value = isset($this->$field_name) ? $this->$field_name : $this->creation_parameters[$field_name] ; 
				$value = !isset($value) ? $field_options['default'] : $value ; 

				if(empty($value) && $field_options['required'] && intval($value) != 0){
					trigger_error("$field_name is required.", E_USER_ERROR) ;
				}

				$fields[$field_name] =  $value; 
				$this->$field_name = $value ;
			}

			if(! isset($this->id)){
				$this->new_record = true ; 
				$result = $wpdb->insert(static::table_name(), $fields) ;
				$this->id = $wpdb->insert_id ; 
			} else {
				$this->new_record = false ;
				$wpdb->update(static::table_name(), $fields, array('id' => $this->id)) ;
			}
		}
		
	}

?>