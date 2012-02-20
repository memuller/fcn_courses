<?php 
	namespace FCN ;
	use Presenter as Presenter ; 

	class WaitingListPresenter extends Presenter {
		
		public static function present(){
			if('POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'waitee_signup'){
				return self::post();
			} else if(is_admin()) {
				echo self::admin_index();
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

		public static function admin_index(){
			global $post ; 
			if(isset($_GET['course_id'])){
				$post = get_post($_GET['course_id']) ;
			} else {
				$post = get_posts("post_type=courses&order_by=post_date&order=desc&limit=1") ;
				$post = $post[0] ;
			}

			return self::render_to_string('admin/waiting_list', array('post' => $post)) ;
		}


	}

 ?>