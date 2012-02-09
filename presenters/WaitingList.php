<?php 
	namespace FCN ;
	use Presenter as Presenter ; 

	class WaitingListPresenter extends Presenter {
		
		public static function present(){
			if('POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'waitee_signup'){
				return self::post();
			} else {
				return self::index() ;
			} 
		}

		public static function index(){
			global $post ;
			return self::render_to_string('waiting_list/form', array('post' => $post)) ;
		}

		public static function post(){
			if(wp_verify_nonce($_POST['nonce'], 'waitee_signup')){
				$waitee = Waitee::find_or_create($_POST['waitee']) ;
				return self::render_to_string('waiting_list/form', array('success' => $waitee->new_record, 'waitee' => $waitee)) ;
			}
		}


	}

 ?>