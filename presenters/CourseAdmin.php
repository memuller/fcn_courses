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
			$course = new Course() ;
			switch ($collumn_name) {
				case 'waitee':
					echo sizeof($course->waitees()) ;
					break;
			}
		}

		static function build(){
			add_filter( 'manage_edit-courses_columns', 'FCN\CourseAdminPresenter::collumn_headers', 10, 1);
			add_action( 'manage_posts_custom_column', 'FCN\CourseAdminPresenter::collumn_info', 10, 2);
		}
	}

 ?>