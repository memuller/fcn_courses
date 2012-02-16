<?php
	namespace FCN ;  
	
	class Edition {

		static $name = "classes" ;
		static $creation_fields = array( 
			'label' => 'Classes','description' => "Classes os FCN's courses.",
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => true,  'rewrite' => array('slug' => ''),'query_var' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields',
				'comments','revisions','thumbnail'),
			'labels' => array (
				'name' => 'Classes',
				'singular_name' => 'Class',
				'menu_name' => 'Classes',
				'add_new' => 'Add Class',
				'add_new_item' => 'Add New Class',
				'edit' => 'Edit',
				'edit_item' => 'Edit Class',
				'new_item' => 'New Class',
				'view' => 'View Class',
				'view_item' => 'View Class',
				'search_items' => 'Search Classes',
				'not_found' => 'No Classes Found',
				'not_found_in_trash' => 'No Classes Found in Trash',
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
			add_action('init', 'FCN\Edition::create_post_type' ) ;
		}
		
	}

 ?>