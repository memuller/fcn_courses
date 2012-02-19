<?php 
	/*
	Plugin Name: FCN Courses Manager
	Version: 0.0.1
	Plugin URI: http://github.com/memuller/fcn_courses
	Description: Manages inscriptions, classes and waiting lists for Faculdade Canção Nova courses.
	Author: Matheus Muller
	Author URI: http://memuller.com
	*/

	/*
	Copyright (c) 2012, Matheus Muller

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	*/

	# Sets db version.
	$fcn_courses_db_version = '0.5' ;

	# Sets base plugin path. With backslashes.
	$plugin_path = plugin_dir_path(__FILE__) ;

	# Sets base url.
	$plugin_url = WP_PLUGIN_URL . "/"."fcn_courses"."/" ;

	# Requires vendored libs and base structure.
	require_once 'vendors/haml/HamlParser.class.php' ;
	require_once 'vendors/jw_custom_posts/jw_custom_posts.php' ;
	require_once 'lib/Presenter.php' ;
	require_once 'lib/DB_Object.php' ;

	# Requires models and presenters.
	require_once 'models/Course.php' ; FCN\Course::build() ; 
	require_once 'models/Edition.php' ; FCN\Edition::build() ;
	require_once 'models/Person.php' ;
	require_once 'models/Waitee.php' ;
	require_once 'presenters/WaitingList.php' ;
	require_once 'presenters/Registry.php' ;
	require_once 'presenters/CourseAdmin.php' ; FCN\CourseAdminPresenter::build() ;
	require_once 'presenters/EditionAdmin.php' ; FCN\EditionAdminPresenter::build() ;

	function fcn_courses_enforce_db(){
		global $fcn_courses_db_version ;
		if(get_option('fcn_courses_db_version') != $fcn_courses_db_version){
			FCN\Person::build_database() ;
			FCN\Waitee::build_database() ;
			update_option('fcn_courses_db_version', $fcn_courses_db_version) ; 
		}
	}

	function fcn_show_forms($content){
		global $post ;  
		if($post->post_type == 'courses'){
			$content .= FCN\RegistryPresenter::present() ; 
		}
		return $content ; 
	}
	
	function fcn_frontend_codes(){
		global $post ;

		if($post->post_type == 'courses'){

			# general JS
			wp_enqueue_script('jquery-validate', plugins_url('static/js/jquery-validate/jquery.validate.js', __FILE__), array('jquery')) ;
			wp_enqueue_script('jquery-metadata', plugins_url('static/js/jquery-metadata/jquery.metadata.js', __FILE__), array('jquery')) ;
			wp_enqueue_script('jquery-datepick', plugins_url('static/js/jquery-datepick/jquery.datepick.js', __FILE__), array('jquery')) ;
			wp_enqueue_script('jquery-datepick-br', plugins_url('static/js/jquery-datepick/jquery.datepick-pt-BR.js', __FILE__), 
				array('jquery', 'jquery-datepick')) ;
			wp_enqueue_script('mask', plugins_url('static/js/mask/mask.js', __FILE__), array('jquery')) ;

			# general CSS
			wp_enqueue_style('fcn-courses', plugins_url('static/css/main.css', __FILE__)) ;
			wp_enqueue_style('jquery-datepick', plugins_url('static/js/jquery-datepick/jquery.datepick.css', __FILE__)) ;

			# registration/waiting list specific JS
			wp_enqueue_script('class-registration', plugins_url('static/js/class_registration.js', __FILE__), 
				array('jquery-datepick', 'jquery-metadata','jquery-validate', 'mask') ) ;
			wp_enqueue_script('waiting-list', plugins_url('static/js/waiting_list.js', __FILE__), 
				array('jquery-datepick', 'jquery-metadata','jquery-validate', 'mask') ) ;
		}
	}

	function fcn_backend_styles(){
		global $plugin_url ;
		wp_enqueue_style('jquery-datepick', plugins_url('static/js/jquery-datepick/jquery.datepick.css', __FILE__)) ;
	}

	function fcn_backend_scripts(){
		global $plugin_url ;

		wp_enqueue_script('jquery-fixer', plugins_url('static/js/jquery.fixer.js', __FILE__), array('jquery')) ;
		wp_enqueue_script('jquery-datepick', plugins_url('static/js/jquery-datepick/jquery.datepick.js', __FILE__), array('jquery')) ;
		wp_enqueue_script('jquery-datepick-br', plugins_url('static/js/jquery-datepick/jquery.datepick-pt-BR.js', __FILE__), 
			array('jquery', 'jquery-datepick'))  ;
		wp_enqueue_script('edition_admin', plugins_url('static/js/edition_admin.js', __FILE__), array('jquery-datepick-br')) ;
	}


	function deRegisterJquery() {
	    wp_deregister_script( 'jquery' );
	}    
 
	add_action('wp_enqueue_scripts', 'deRegisterJquery');
	
	add_filter('the_content', 'fcn_show_forms') ;
	add_action('plugins_loaded', 'fcn_courses_enforce_db') ;
	add_action('wp_enqueue_scripts', 'fcn_frontend_codes') ;

?>