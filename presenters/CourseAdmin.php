<?php 
	namespace FCN ; 
	class CourseAdminPresenter {

		static function collumn_headers($collumns){
			if (! isset($collumns['waitee'])) {
				$collumns['waitee'] = 'Waiting List' ;
			}
			print_r($collumns) ;
			return $collumns ;
		}
		
		static function collumn_info($collumn_name, $post_id){
			
			switch ($collumn_name) {
				
				case 'waitee':
					$course = new Course() ;
					echo sizeof($course->waitees()) ;
					break;
			}
		}

		static function waiting_list_page(){
			add_submenu_page('edit.php?post_type=courses', 'Waiting List', 'Waiting Lists',  
				'edit_posts', 'waiting_list', 'FCN\WaitingListPresenter::present' ); 
		}

		static function build(){
			add_filter( 'manage_edit-courses_columns', 'FCN\CourseAdminPresenter::collumn_headers', 10, 1);
			add_action( 'manage_posts_custom_column', 'FCN\CourseAdminPresenter::collumn_info', 10, 2);
			add_action( 'admin_menu', 'FCN\CourseAdminPresenter::waiting_list_page' ) ;
		}
	}

 ?>