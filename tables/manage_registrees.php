<?php 
	namespace FCN ;
	use WP_List_Table ;

	class ManageRegistrees extends WP_List_Table {

		function __construct(){
			parent::__construct(array(
				'singular' => 'registree',
				'plural' => 'registrees',
				'ajax' => false
			)) ;
		}

		function extra_tablenav($position){
			
			if($position == 'top'){
				
			}

			if($position == 'bottom'){

			}

		}

		function get_columns(){
			return $columns = array(
				'registree_name' => 'Nome',
				'registree_email' => 'Email'
			) ;
		}

		function column_registree_name($item){
			$actions = array(
				'more_info' => sprintf("<a class='thickbox' href='inlineId=%s'>%s</a>", "registree_".$item->ID."_additional_info", 'Mais Informações' )  
			);
			return $item->name . $this->row_actions($actions) ;
		}

		function column_registree_email($item){
			echo $item->email ;
		}

		function get_sortable_columns(){
			return $sortable = array( 
			);
		}

		function prepare_items(){
			global $wpdb, $post ;
			$class = new Edition($post) ;

			$sql = "select * from " . Registree::table_name() . " registree inner join ". Person::table_name() . " person 
				on person_id = person.id where class_id = $class->ID" ;

			$total_items = $wpdb->get_var( str_replace("*", "count(registree.id)", $sql) ) ;

			$per_page = 5 ;
			$page = $this->get_pagenum() ;

			$total_pages = ceil($total_items / $per_page) ;

			if(!empty($page)){
				$offset = ($page -1) * $per_page ;
				$sql .= sprintf(" limit %d, %d", $offset, $per_page) ;
			}

			$this->set_pagination_args(array(
				'total_items' => $total_items, 'total_pages' => $total_pages , 'per_page' => $per_page
			));

			$this->_column_headers = array($this->get_columns(), array(), array()) ;
			$this->items = $wpdb->get_results($sql) ;
			
		}

	}

 ?>