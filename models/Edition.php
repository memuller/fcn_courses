<?php
	namespace FCN ;  
	
	class Edition {

		static $name = "classes" ;
		static $creation_fields = array( 
			'label' => 'Classes','description' => "Classes os FCN's courses.",
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => true,  'rewrite' => array('slug' => ''),'query_var' => true,
			'supports' => array('custom-fields'),
			'labels' => array (
				'name' => 'Classes',
				'singular_name' => 'Class',
				'menu_name' => 'Classes',
				'add_new' => 'Add Class',
				'add_new_item' => 'Add New Class',
				'edit' => 'Manage',
				'edit_item' => 'Manage Class',
				'new_item' => 'New Class',
				'view' => 'View Class',
				'view_item' => 'View Class',
				'search_items' => 'Search Classes',
				'not_found' => 'No Classes Found',
				'not_found_in_trash' => 'No Classes Found in Trash',
				'parent_item_colon' => 'Course: '
			)
		) ;
		static $fields = array(
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'signup_start_date' => array('type' => 'date'),
			'signup_end_date' => array('type' => 'date'),
			'signup_cost' => array('type' => 'money'),
			'signup_spaces' => array('type' => 'integer')
		) ;

		public $post ; 

		function __get($name){
			global $post ;
			if(isset(static::$fields[$name])){
				return get_post_meta($post->ID, $name, true) ;
			} else {
				return $post->$name ; 
			}
		}

		function datetime($field){
			if($fields[$field]['type'] == 'date'){
				$date = explode('/', $this->$field) ;
				$date = sprintf("%s-%s-%s", $date[2], $date[1], $date[0]);
				return new DateTime($date) ;
			}
		}

		function __construct($args=array()){
			
		}



		static function create_post_type(){

			register_post_type( self::$name, self::$creation_fields ) ;
		}

		static function build(){
			add_action('init', 'FCN\Edition::create_post_type' ) ;
		}
		
	}

 ?>