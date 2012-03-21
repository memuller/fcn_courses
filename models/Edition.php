<?php
	namespace FCN ;  
	use DateTime ;
	class Edition {

		static $name = "classes" ;
		static $creation_fields = array( 
			'label' => 'Turma', 'description' => 'Turma em um curso de extensão da FCN.',
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => true,  'rewrite' => array('slug' => ''),'query_var' => true,
			'supports' => array('custom-fields'),
			'labels' => array (
				'name' =>  'Turmas' ,
				'singular_name' => 'Turma',
				'menu_name' => 'Turmas',
				'add_new' => 'Criar Turma',
				'add_new_item' => 'Criar nova Turma',
				'edit' => 'Gerenciar',
				'edit_item' => 'Gerenciar Turma',
				'new_item' => 'Nova Turma',
				'view' => 'Ver Turma',
				'view_item' => 'Ver Turma',
				'search_items' => 'Buscar Turmas',
				'not_found' => 'Nenhuma turma encontrada',
				'not_found_in_trash' => 'Nenhuma turma encontrada na lixeira.',
				'parent_item_colon' => 'Curso: '
			)
		) ;
		static $fields = array(
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'signup_start_date' => array('type' => 'date'),
			'signup_end_date' => array('type' => 'date'),
			'signup_cost' => array('type' => 'money'),
			'signup_spaces' => array('type' => 'integer'),
			'pending_signups_expiry_time' => array('type' => 'integer'),
			'human_time' => array()
		) ;

		public $post ; 

		function __get($name){
			global $post ;
			if(isset(static::$fields[$name])) {
				return get_post_meta($post->ID, $name, true) ;
			} else {
				return isset($this->post) ? $this->post->$name : $post->$name ; 
			}
		}

		function datetime($field){
			if(static::$fields[$field]['type'] == 'date'){
				$date = explode('/', $this->$field) ;
				$date = sprintf("%s-%s-%s", $date[2], $date[1], $date[0]);
				return new DateTime($date) ;
			}
		}

		function accepts_signups(){
			return $this->in_time_for_signups() && (int) $this->remaining_spaces() > 0;
		}

		function in_time_for_signups(){
			$now = new DateTime('now');
			$in_time = $this->datetime('signup_start_date') <= $now && $this->datetime('signup_end_date') >= $now ; 
			
			return (bool)$in_time ; 
		}

		function confirmed_registrees (){
			return Registree::all(array('count' => true, 'where' => array( 
				'class_id' => $this->ID, 'status' => 'valid' )  )) ;
		}

		function remaining_spaces(){
			return ((int) $this->signup_spaces) - $this->confirmed_registrees() ;
		}

		function pending_registrees(){
			return Registree::all(array('count' => true, 'where' => array( 
			'class_id' => $this->ID, 'status' => 'pending', 'or status' => 'validating' ))) ;
		}

		function vips(){
			return Registree::all(array('count' => true, 'where' => array(
				'class_id' => $this->ID, 'status' => 'valid', 'pays' => 0 )));
		}

		function income(){
			$count = Registree::all(array('count' => true, 'where' => array(
				'class_id' => $this->ID, 'status' => 'valid', 'pays' => 1 )));
			return $count * $this->signup_cost ;
		}


		function registrees($args = array()){
			global $wpdb ; $registrees = array() ;
			$sql = "select registree.*, ". Person::field_list('person') . " from " . Registree::table_name() . " registree inner join ". Person::table_name() . " person 
				on person_id = person.id where class_id = $this->ID order by status asc" ;
				
			foreach ($wpdb->get_results($sql, ARRAY_A) as $registree) {
				$registrees[]= new Registree($registree, false) ;
			}

			return $registrees ;
		}

		function __construct($post=false){
			if($post){
				if(is_numeric($post)) $post = get_post($post) ;
				$this->post = $post ; 
				foreach(get_post_custom($post->ID) as $field_name => $field_values){
					if(isset(static::$fields[$field_name])){
						$this->$field_name = $field_values[0] ;
					}
				}
			}
		}



		static function create_post_type(){

			register_post_type( self::$name, self::$creation_fields ) ;
		}

		static function build(){
			add_action('init', 'FCN\Edition::create_post_type' ) ;
		}
		
	}

 ?>