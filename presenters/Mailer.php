<?php 
	namespace FCN ; 
	use Presenter ;
	
	class MailerPresenter extends Presenter {

		function payment_request($registree){
			$class = new Edition($registree->class_id) ;
			$course = new Course($class->course_id) ;
			$mail = static::render_to_string('mail/payment_request', array('registree' => $registree, 'course' => $course) );
			#$sucess = wp_mail($registree->person->)
		}

		function payment_reminder(){

		}

		function payment_failure(){

		}

		function success(){

		}


	}

 ?>
