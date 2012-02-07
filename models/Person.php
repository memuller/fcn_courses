<?php 
	namespace FCN ;

	class Person {

		static $table_name ; 
		static $fields = array('name','email','phone') ;

		static function get_table_name(){
			global $wpdb ;
			if(!isset(self::$table_name)){
				self::$table_name = $wpdb->prefix . 'fcn_people' ;
			}
		}

		static function build_database(){
			global $wpdb ;
			
			require_once ABSPATH . 'wp-admin/includes/upgrade.php' ;
			self::get_table_name();

			$sql = sprintf("CREATE TABLE %s (
				id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
				name VARCHAR(150) NOT NULL,
				email VARCHAR(150) NOT NULL,
				phone VARCHAR(50) NULL,
				registered_in DATETIME NOT NULL,
				PRIMARY KEY id (id),
				UNIQUE KEY email (email)
			);", self::$table_name) ;
			dbDelta($sql) ;		
		}

		function __construct($args){
			
		}
	}

?>