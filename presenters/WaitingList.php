<?php 
	namespace FCN ;
	use Presenter as Presenter ; 

	class WaitingListPresenter extends Presenter {
		
		public static function present(){
			self::index ; 
		}

		public static function index(){
			return self::render_to_string('waiting_list/form') ;
		}

	}

 ?>