<?php
	namespace FCN ;  
	
	class Course {

		static $name = "courses" ;
		static $creation_fields = array( 
			'label' => 'Courses','description' => 'Courses applied by FCN.',
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,
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

		static function create_post_type(){
			register_post_type( self::$name, self::$creation_fields ) ;
		}

		static function build(){
			add_action('init', 'FCN\Course::create_post_type' ) ;
		}
		
	}

 ?>