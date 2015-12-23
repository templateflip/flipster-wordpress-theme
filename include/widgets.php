<?php
/*-----------------------------------------------------------------------------------*/
/*	Add our custom widgets
/*-----------------------------------------------------------------------------------*/ 

if(!function_exists('shamrock_register_widgets')) :
	function shamrock_register_widgets(){
			
			//Include widget classes
	 		require_once('widgets/posts.php');
	 		require_once('widgets/video.php');

	 		// Regidter widgets
			register_widget('SMR_Posts_Widget');
			register_widget('SMR_Video_Widget');
			

	}
endif;

?>