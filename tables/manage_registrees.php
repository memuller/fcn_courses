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
				global $post ; $edition = new Edition($post) ;
				$reg = $edition->registrees() ;	
				return CourseAdminPresenter::class_information() ;		
			}

			if($position == 'bottom'){

			}

		}

		function get_columns(){
			return $columns = array(
				'registree_information' => 'Inscrito',
				'registree_contact' => 'Contato',
				'registree_status' => 'Estado'
			) ;
		}

		function column_registree_information($registree){
			$actions = array(
				'more_info' => sprintf("<a class='thickbox' href='inlineId=%s'>%s</a>", "registree_".$registree->ID."_additional_info", 'Mais Informações' )  
			);
			return  "<div style='font-weight:bold;'>".$registree->person->name."</div>" . $registree->person->address() ;
		}

		function column_registree_contact($registree){
			$returnable =  "<div>".$registree->person->email."</div>".$registree->person->phone ;
			$returnable .= !empty($registree->person->mobile) ? " / ". $registree->person->mobile : "" ;
			return $returnable ;
		}

		function column_registree_status($registree){
			if( (int) $registree->pays == 0) return "<div class='vip'>".__('VIP')."</div>" ;

			switch ($registree->status) {
				case 'pending':
					$text = __('Aguardando Pagamento') ;
					break;
				case 'validating':
					$text = "<a href='#' id='registree_".$registree->id."_show_form' >" .__('Aguardando Aprovação') . "</a>";
					$form = EditionAdminPresenter::payment_confirmation_form($registree);
					break;
				case 'valid':
					$text = __('Inscrito') ;
					break;
				case 'invalid':
					$text = __('Cancelada') ;
					break;
			}
			return "<div class='$registree->status'> $text </div>" . $form ;
		}

		function get_sortable_columns(){
			return $sortable = array( 
			);
		}

		function prepare_items(){
			global $wpdb, $post ;
			$class = new Edition($post,false) ;

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
			$this->items = $class->registrees();
			
		}

	}

 ?>