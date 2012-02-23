<?php 
	namespace FCN ; 
	use Presenter ;
	class EditionAdminPresenter extends Presenter {

	static function registrees_metabox($post){
		global $plugin_path ;
		if(!empty($post->post_title) && $post->title != __('Auto Draft')){
			require_once($plugin_path .'tables/manage_registrees.php') ;
			$table = new ManageRegistrees();
			$table->prepare_items();
			$table->display();
		} else {
			_e("Conclua o cadastro desta turma antes de gerenciar inscrições.") ;
		}
	}
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

			if(isset($_POST['registree_payment_change'])){
				$arr = explode('_', $_POST['registree_payment_change']) ;
				$verb = $arr[0] ; $registree = new Registree($arr[3]) ;
				
				if($verb == 'accept'){
					$registree->status = 'valid' ; $registree->persist() ;
				} else {
					$registree->status = 'invalid' ; $registree->persist() ;
				}
			}

			$course = get_post($_POST['parent_id']) ;
			foreach(Edition::$fields as $field_name => $field_options){
				if(! empty($_POST[$field_name])){
					update_post_meta($post_id, $field_name, $_POST[$field_name]) ;
				}
			}
		}
	}

	static function payment_confirmation_form($registree){
		return static::render_to_string('admin/payment_confirmation_form', array('registree' => $registree)) ;
	}

		static function build(){

			add_action('add_meta_boxes', function() { add_meta_box('class-registrees', 'Inscrições', "FCN\EditionAdminPresenter::registrees_metabox", 
				'classes', 'normal', 'core');});

			add_action('add_meta_boxes', function() { add_meta_box('class-info', 'Informações da Turma', "FCN\EditionAdminPresenter::class_metabox", 
				'classes', 'side', 'high');});

			add_action('add_meta_boxes', function() { add_meta_box('class-signup', 'Inscrições', "FCN\EditionAdminPresenter::signup_metabox", 
				'classes', 'side', 'high');});
			
			add_action('save_post','FCN\EditionAdminPresenter::save') ;
			add_action('title_save_pre', 'FCN\EditionAdminPresenter::title_pre_save') ;
			
			# JS and CSS includes
			add_action('admin_print_scripts', 'fcn_backend_scripts') ;
			add_action('admin_print_styles', 'fcn_backend_styles') ;

		}
	}

 ?>
