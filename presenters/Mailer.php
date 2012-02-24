<?php 
	namespace FCN ; 
	use Presenter ;
	
	class MailerPresenter extends Presenter {

		static function payment_request($registree){
			$class = new Edition($registree->class_id) ;
			$course = new Course($class->course_id) ;
			$mail = static::render_to_string('email/payment_request', array('registree' => $registree, 'course' => $course) );
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			$success = wp_mail($registree->person->email, "FCN: Aguardando Pagamento", $mail) ;
		}

		function payment_reminder(){

		}

		function payment_failure(){

		}

		function success(){

		}


	}

 ?>
