<?php 
	namespace FCN ; 
	use Presenter ;
	use DateTime ;
	class CronPresenter extends Presenter {

		static function process_pending_registrees(){
			foreach (get_posts(array('post_type' => 'classes'), ARRAY_A) as $class) {
				$class = new Edition($class) ;
				if( $class->accepts_signups()){
					$course = new Course($class->post_parent) ;
					foreach ($class->registrees() as $registree) { 
						if($registree->status == 'pending'){
							$now = new DateTime('now') ;
							
							if ( $registree->kill_date() <= $now && $registree->alerted_about_payment ){
								$registree->status = 'invalid' ;
								$registree->persist() ;
							}

							if ( $registree->alert_date() <= $now && ! $registree->alerted_about_payment ){
								$registree->alerted_about_payment = 1;
								$registree->persist() ;
								MailerPresenter::payment_reminder($registree) ;
							}
						}

					}
				}

			}
		}

		static function build(){
			add_action('fcn_process_pending_registrees', 'FCN\CronPresenter::process_pending_registrees') ;
			if(!wp_next_scheduled('fcn_process_pending_registrees')){
				wp_schedule_event(time(), 'daily', 'fcn_process_pending_registrees') ;
			}
		}


	}

 ?>
