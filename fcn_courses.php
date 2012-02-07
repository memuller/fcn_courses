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

	# Sets base plugin path. With backslashes.
	$plugin_path = plugin_dir_path(__FILE__) ;

	# Requires vendored libs.
	require_once 'vendors/haml/HamlParser.class.php' ;
	require_once 'vendors/jw_custom_posts/jw_custom_posts.php' ;
	
	# Requires base Presenter structure.
	require_once 'lib/Presenter.php' ;

	# Requires base models.
	require_once 'models/Course.php' ;
	FCN\Course::build() ; 



?>