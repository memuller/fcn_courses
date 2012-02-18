<?php 
	namespace FCN ; 
	use Presenter ;
	class EditionAdminPresenter extends Presenter {

	static function class_metabox($post) {
		$post_type_object = get_post_type_object($post->post_type);
		if ( $post_type_object->hierarchical ) {
			$courses_menu = wp_dropdown_pages(array('post_type' => 'courses', 
				'selected' => isset($_REQUEST['parent_course']) ? $_REQUEST['parent_course'] : $post->post_parent, 
				'name' => 'parent_id', 'echo' => false));
		}

		$edition = new Edition();

		static::render('admin/class_metabox', array('edition' => $edition, 'courses_menu' => $courses_menu)) ;
	}

	static function signup_metabox($post) {
		$edition = new Edition() ;
		static::render('admin/signup_metabox', array('edition' => $edition)) ;
	}


	static function title_pre_save($title){
		if($_POST['post_type'] == 'classes'){
			$start_date = explode('/', $_POST['start_date']) ;
			$title =  sprintf("%s/%s", $start_date[1],$start_date[2]) ;
		} 
		return $title ;
	}

	static function save($post_id){
		if( defined(DOING_AUTOSAVE) && DOING_AUTOSAVE) return ;
		
		if($_POST['post_type'] == 'classes'){
			$course = get_post($_POST['parent_id']) ;
			foreach(Edition::$fields as $field_name => $field_options){
				if(! empty($_POST[$field_name])){
					update_post_meta($post_id, $field_name, $_POST[$field_name]) ;
				}
			}
		}
	}

		static function build(){
			add_action('add_meta_boxes', function() { add_meta_box('class-info', 'Class information', "FCN\EditionAdminPresenter::class_metabox", 
				'classes', 'side', 'high');});

			add_action('add_meta_boxes', function() { add_meta_box('class-signup', 'Signup information', "FCN\EditionAdminPresenter::signup_metabox", 
				'classes', 'side', 'high');});
			
			add_action('save_post','FCN\EditionAdminPresenter::save') ;
			add_action('title_save_pre', 'FCN\EditionAdminPresenter::title_pre_save') ;
			
			# JS and CSS includes
			add_action('admin_print_scripts', 'fcn_backend_scripts') ;
			add_action('admin_print_styles', 'fcn_backend_styles') ;

		}
	}

 ?>