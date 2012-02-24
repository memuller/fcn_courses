<?php 
	namespace FCN ;
	use Presenter as Presenter ; 

	class RegistryPresenter extends Presenter {
		
		public static function present(){
			if('POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'registree_signup'){
				return self::post();
			} elseif ('POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'payment_confirmation' ) {
				return self::post_payment() ;
			} elseif(isset($_GET['payment_for']) && is_email($_GET['payment_for']) ){
				return self::payment_request();
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

		public static function payment_request(){
			$course = new Course() ; $class = $course->running_classes() ;
			if(! empty($class)){ $class = $class[0] ;
				$registree = Registree::find_or_create(array('person_email' => $_GET['payment_for'], 'class_id' => $class->ID )) ;
				return self::render_to_string('registry/payment_request', array(
						'registree' => $registree, 'class' => $class, 'course' => $course)) ;
			}
		}

		public static function post(){
			if(wp_verify_nonce($_POST['nonce'], 'registree_signup')){
				$course = new Course ; $class = new Edition($_POST['registree']['class_id']) ; 
				$registree = Registree::find_or_create($_POST['registree']) ;
				if($registree->new_record){
					MailerPresenter::payment_request($registree) ;
					return self::render_to_string('registry/payment_request', array(
						'registree' => $registree, 'class' => $class, 'course' => $course, 'success' => true)) ;
				} else {
					return self::render_to_string('registry/form', array('class' => $class, 'success' => false)) ;
				}
			}
		}

		public static function post_payment(){
			if(wp_verify_nonce($_POST['nonce'], 'payment_confirmation')){
				$confirmation = $_POST['payment-confirmation'] ; 
				$registree = new Registree($confirmation['registree_id']) ;
				$course = new Course($registree->course_id) ;
				$file = $_FILES['payment-confirmation'] ;
				if(! empty($file['name']['file'])){
					$supported_mimetypes = array('image/jpeg', 'image/png', 'image/gif') ;
					$type = wp_check_filetype(basename($file['name']['file'])) ;
					$type = $type['type'] ;
					if(in_array($type, $supported_mimetypes)){
						$upload = wp_upload_bits($file['name']['file'], null, file_get_contents($file['tmp_name']['file']) ) ;
						if($upload['error']) $error = true ; 
						$registree->payment_receipt = $upload['url'] ;
					} else {
						$error = true ; 
					}
				} else {
					if(empty($confirmation['text'])) $error = true ;
					$registree->payment_receipt = $confirmation['text'] ;
				}

				if(! isset($error)){
					$registree->paid_up = date('Y-m-d H:i:s') ;
					$registree->status = 'validating' ;
					$registree->persist();
					return self::render_to_string('registry/payment_confirmation', array('registree' => $registree, 'course' => $course)) ;
				} else {
					return self::render_to_string('registry/payment_error') ;
				}

				
			}
		}


	}

 ?>