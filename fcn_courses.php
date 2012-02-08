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
	$fcn_courses_db_version = '0.2' ;

	# Sets base plugin path. With backslashes.
	$plugin_path = plugin_dir_path(__FILE__) ;

	# Requires vendored libs and base structure.
	require_once 'vendors/haml/HamlParser.class.php' ;
	require_once 'vendors/jw_custom_posts/jw_custom_posts.php' ;
	require_once 'lib/Presenter.php' ;

	# Requires models and presenters.
	require_once 'models/Course.php' ; FCN\Course::build() ; 
	require_once 'models/Person.php' ;
	require_once 'presenters/WaitingList.php' ;

	function fcn_courses_enforce_db(){
		global $fcn_courses_db_version ;
		if(get_option('fcn_courses_db_version') != $fcn_courses_db_version){
			FCN\Person::build_database() ;
			update_option('fcn_courses_db_version', $fcn_courses_db_version) ; 
		}
	}

	function fcn_show_forms($content){
		global $post ;  
		if($post->post_type == 'courses'){
			$content .= FCN\WaitingListPresenter::index() ; 
		}
		return $content ; 
	}

	add_filter('the_content', 'fcn_show_forms') ;
	add_action('plugins_loaded', 'fcn_courses_enforce_db') ;


?>