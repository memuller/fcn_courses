<?php 
	namespace FCN ;

	class Person {

		static function build_database(){
			global $wpdb ;
			require_once ABSPATH . 'wp-admin/includes/upgrade.php' ;
			$table_name = $wpdb->prefix.'fcn_people' ;
			$sql = sprintf("CREATE TABLE %s (
				id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
				name VARCHAR(150) NOT NULL,
				email VARCHAR(150) NOT NULL,
				phone VARCHAR(50) NULL,
				registered_in DATETIME NOT NULL,
				PRIMARY KEY id (id),
				UNIQUE KEY email (email)
			);", $table_name) ;
			dbDelta($sql) ;		
		}
	}

?>