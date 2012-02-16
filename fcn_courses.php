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

	# Requires vendored libs and base structure.
	require_once 'vendors/haml/HamlParser.class.php' ;
	require_once 'vendors/jw_custom_posts/jw_custom_posts.php' ;
	require_once 'lib/Presenter.php' ;
	require_once 'lib/DB_Object.php' ;

	# Requires models and presenters.
	require_once 'models/Course.php' ; FCN\Course::build() ; 
	require_once 'models/Person.php' ;
	require_once 'models/Waitee.php' ;
	require_once 'presenters/WaitingList.php' ;
	require_once 'presenters/CourseAdmin.php' ; FCN\CourseAdminPresenter::build() ;

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
			$content .= FCN\WaitingListPresenter::present() ; 
		}
		return $content ; 
	}

	function fcn_css() { 
		//inserindo tag html direto
		?>
		<link rel="stylesheet" href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/fcn_courses/static/css/main.css" type="text/css" media="screen"/>
		<script src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/fcn_courses/static/js/doValidate.js" type="text/javascript" charset="utf-8"></script>
	<?php }

	function deRegisterJquery() {
	    wp_deregister_script( 'jquery' );
	}    
 
	add_action('wp_enqueue_scripts', 'deRegisterJquery');
	
	add_filter('the_content', 'fcn_show_forms') ;
	add_action('plugins_loaded', 'fcn_courses_enforce_db') ;
	add_action('wp_head', 'fcn_css') ;
?>