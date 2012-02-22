<?php 
	namespace FCN ; 
	class CourseAdminPresenter {

		static function collumn_headers($collumns){
			if(! isset($collumns['waitee'])) $collumns['waitee'] = 'Lista de espera' ;
			if(! isset($collumns['classes'])) $collumns['classes'] = 'Turmas' ;
			return $collumns ;
		}
		
		static function collumn_info($collumn_name, $post_id){
			$course = new Course() ;
			switch ($collumn_name) {
				
				case 'waitee':
					echo sizeof($course->waitees()) ;
					break;
				
				case 'classes' :
					foreach ($course->classes() as $class) { $class = new Edition($class) ;?>
						<?php if($open = $class->accepts_signups()) { ?> <b> <?php } ?>
							<a href="<?php echo admin_url("post.php?post=$class->ID&action=edit") ?>"><?php echo $class->post_title ?></a>
						<?php if($open) { ?> </b> <?php } ?>
					<?php }
					break;
			}
		}

		static function waiting_list_page(){
			add_submenu_page('edit.php?post_type=courses', 'Lista de Espera', 'Listas de Espera',  
				'edit_posts', 'waiting_list', 'FCN\WaitingListPresenter::present' ); 
		}

		static function build(){
			add_filter( 'manage_edit-courses_columns', 'FCN\CourseAdminPresenter::collumn_headers', 10, 1);
			add_action( 'manage_pages_custom_column', 'FCN\CourseAdminPresenter::collumn_info', 10, 2);
			add_action( 'admin_menu', 'FCN\CourseAdminPresenter::waiting_list_page' ) ;
		}
	}

 ?>