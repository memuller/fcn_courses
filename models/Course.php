<?php
	namespace FCN ;  
	
	class Course {

		static $name = "courses" ;
		static $creation_fields = array( 
			'label' => 'Courses','description' => 'Courses applied by FCN.',
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields',
				'comments','revisions','thumbnail'),
			'labels' => array (
				'name' => 'Courses',
				'singular_name' => 'Course',
				'menu_name' => 'Courses',
				'add_new' => 'Add Course',
				'add_new_item' => 'Add New Course',
				'edit' => 'Edit',
				'edit_item' => 'Edit Course',
				'new_item' => 'New Course',
				'view' => 'View Course',
				'view_item' => 'View Course',
				'search_items' => 'Search Courses',
				'not_found' => 'No Courses Found',
				'not_found_in_trash' => 'No Courses Found in Trash',
				'parent' => 'Parent Course'
			)
		) ;

		public $post ; 

		function __get($name){
			global $post ; 
			return $post->$name ; 
		}

		function __construct($args=array()){
			
		}

		function classes(){
			global $wpdb ;
			$sql = $wpdb->prepare("SELECT ID, post_title from $wpdb->posts where post_status = %s and post_parent = %d", 
				'publish',$this->ID) ;
			return $wpdb->get_results($sql) ;
		}

		function waitees(){
			global $wpdb ;
			$waitee_table = Waitee::table_name() ; $person_table = Person::table_name();
			$sql = $wpdb->prepare("SELECT * from $waitee_table, $person_table 
				WHERE $person_table.id = $waitee_table.person_id 
				AND $waitee_table.course_id = %d ;", $this->ID
			);
			return $wpdb->get_results($sql) ;
		}

		static function create_post_type(){

			register_post_type( self::$name, self::$creation_fields ) ;
		}

		static function build(){
			add_action('init', 'FCN\Course::create_post_type' ) ;
		}
		
	}

 ?>