<?php 
	
	class Presenter {

		static function render_to_string($view, $scope=array()){
			global $plugin_path , $plugin_haml_parser ; 
			
			$path = $plugin_path . 'views/'; 
			
			if(file_exists($path . $view . '.php')){
				extract($scope) ;
				require $path . $view . '.php' ; return ;
			}

			if( ! isset($plugin_haml_parser)) $plugin_haml_parser = new HamlParser($path, $path);
			
			if ( ! empty($scope)) $plugin_haml_parser->append($scope);
			
			return $plugin_haml_parser->fetch($view . '.haml') ;
		}

		static function render ($view, $scope=array()){
			echo self::render_to_string($view, $scope) ;
		}

		static function render_partial($partial, $scope=array()){
			$exploded_path = explode('/',$partial) ;
			$exploded_path[sizeof($exploded_path)-1] = "_".$exploded_path[sizeof($exploded_path)-1] ;
			$partial = implode('/', $exploded_path) ;
			return self::render_to_string($partial, $scope) ;
		}
		static function render_admin($view, $scope=array()){
			echo self::render_to_string('admin/'. $view, $scope) ;
		}

	}

 ?>