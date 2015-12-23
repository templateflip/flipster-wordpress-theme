<?php

/*-----------------------------------------------------------------------------------*/
/*	Register Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'shamrock_register_menus' ) ) :
    function shamrock_register_menus() {
	    register_nav_menu('shamrock_main_nav', __( 'Main Navigation' , 'shamrock'));
	   	register_nav_menu('shamrock_social_menu', __( 'Social Menu' , 'shamrock'));
	    register_nav_menu('shamrock_footer_menu', __( 'Footer Menu' , 'shamrock'));
    }
endif;

?>