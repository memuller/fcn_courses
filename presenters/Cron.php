<?php 
	namespace FCN ; 
	use Presenter ;
	
	class CronPresenter extends Presenter {

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

		static function success($registree){
			$class = new Edition($registree->class_id) ;
			$course = new Course($class->course_id) ;
			$mail = static::render_to_string('email/success', array('registree' => $registree, 'class' => $class, 'course' => $course) );
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			$success = wp_mail($registree->person->email, "FCN: Inscrição confirmada", $mail) ;
		}


	}

 ?>
