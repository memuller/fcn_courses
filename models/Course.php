<?php
	namespace FCN ;  
	
	class Course {

		static $name = "courses" ;
		static $creation_fields = array( 
			'label' => 'Curso','description' => 'Cursos aplicados pela FCN.',
			'public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post',
			'hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,
			'supports' => array('title','editor', 'excerpt', 'trackbacks','custom-fields',
				'comments','revisions','thumbnail'),
			'labels' => array (
				'name' => 'Cursos',
				'singular_name' => 'Curso',
				'menu_name' => 'Cursos',
				'add_new' => 'Adicionar Curso',
				'add_new_item' => 'Adicionar Novo Curso',
				'edit' => 'Editar',
				'edit_item' => 'Editar Curso',
				'new_item' => 'Novo Curso',
				'view' => 'Ver',
				'view_item' => 'Ver Curso',
				'search_items' => 'Buscar Curso',
				'not_found' => 'Nenhum curso encontrado',
				'not_found_in_trash' => 'Nenhum curso encontrado na lixeira.',
				'parent' => 'Parent Course'
			)
		) ;

		public $post ; 

		function __get($name){
			global $post ; 
			return $post->$name ; 
		}

		function __construct($args=array()){
			
		}

		function classes(){
			global $wpdb ;
			$sql = $wpdb->prepare("SELECT ID, post_title from $wpdb->posts where post_status = %s and post_parent = %d", 
				'publish',$this->ID) ;
			return $wpdb->get_results($sql) ;
		}

		function running_classes(){
			$classes= $this->classes() ; $running_classes = array() ;
			foreach ($classes as $class) {
				$class = new Edition($class) ;
				if($class->accepts_signups()) $running_classes[]= $class ;
			}
			return $running_classes ;
		}

		function waitees(){
			global $wpdb ;
			$waitee_table = Waitee::table_name() ; $person_table = Person::table_name();
			$sql = $wpdb->prepare("SELECT * from $waitee_table, $person_table 
				WHERE $person_table.id = $waitee_table.person_id 
				AND $waitee_table.course_id = %d ;", $this->ID
			);
			return $wpdb->get_results($sql) ;
		}

		static function create_post_type(){

			register_post_type( self::$name, self::$creation_fields ) ;
		}

		static function build(){
			add_action('init', 'FCN\Course::create_post_type' ) ;
		}
		
	}

 ?>