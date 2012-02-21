<?php 
	namespace FCN ;
	use Presenter as Presenter ; 

	class RegistryPresenter extends Presenter {
		
		public static function present(){
			if('POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'registree_signup'){
				return self::post();
			} else {
				return self::index() ;
			} 
		}

		public static function index(){
			$course = new Course() ;
			$class = $course->running_classes() ;
			if( ! empty($class)) {
				$class = $class[0] ;
				return self::render_to_string('registry/form', array('class' => $class)) ;
			} else {
				return WaitingListPresenter::present() ;	
			}
			
		}

		public static function post(){
			if(wp_verify_nonce($_POST['nonce'], 'registree_signup')){
				$course = new Course ; $class = new Edition($_POST['registree']['class_id']) ; 
				$registree = Registree::find_or_create($_POST['registree']) ;
				if($registree->new_record){
					return self::render_to_string('registry/payment_request', array(
						'registree' => $registree, 'class' => $class, 'course' => $course, 'success' => true)) ;
				} else {
					return self::render_to_string('registry/form', array('class' => $class, 'success' => false)) ;
				}
			}
		}


	}

 ?>