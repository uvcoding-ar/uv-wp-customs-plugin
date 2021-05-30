<?php

/* 
*	Plugin Name: UVCoding Service&Custom 
*	Plugin URI: https://uvcoding.com.ar 
*	Description: Plugin con personalizacion y servicios de UVCoding. 
*	Version: 1.0.0 
*	Author: Jorge Pauvels
*	Author URI: mailto:jcvels@uvcoding.com.ar
*	License: GPL 2+ 
*	License URI: https://uvcoding.com.ar 
*/

$site_name = "nombre_del_sitio_web";
$track_id = "id_de_tracking_umami";
$umami_url = "umami_url";
$uptime_id = "uptime_page_id";

add_action( 'login_enqueue_scripts', 'uv_login_logo' );
function uv_login_logo() { 
	
	?>

	 <style type="text/css">

		#login h1 a, .login h1 a
		{
			background-image: url('/wp-content/plugins/uv-customs/img/server-logo.png');
			background-size: 300px;
			height: 300px;
			width: 300px;
		}
		
	 </style>

	<?php

}

add_action( 'admin_menu', 'remove_menus', 999 );
function remove_menus(){
	
	if( !current_user_can('administrator') )
	{	
   	  remove_menu_page( 'edit-comments.php' );
	  remove_menu_page( 'tools.php' );
	  remove_menu_page( 'options-general.php' );
	  remove_menu_page( 'edit.php' );
	  remove_menu_page( 'update-core.php' );
	  remove_menu_page( 'upload.php' );
	  remove_menu_page( 'themes.php' );
	  remove_menu_page( 'users.php' );
	  remove_submenu_page( 'index.php', 'update-core.php' );
	  remove_menu_page( 'edit.php?post_type=page' );
	  remove_menu_page( 'edit.php?post_type=feedback' );
	  remove_menu_page( 'edit.php?post_type=elementor_library' );
	  remove_menu_page( 'jetpack' );   
	}
   
}

add_filter( 'admin_footer_text', 'change_footer');
function change_footer() {

 $any = date('Y');
 echo '©'.$any.' Copyright 2021 © ' $site_name ' | Desarrollada por <strong>UVCoding</strong>';

}

add_action( 'admin_bar_menu', 'support_link', 999 );
function support_link( $wp_admin_bar) {

    $wp_admin_bar->add_node([
        'id' => 'ds',
        'title' => '<span style="color:red;">CONTACTAR CON SOPORTE TÉCNICO UV</span>',
        'href' => 'mailto:info@uvcoding.com.ar?subject=Solicitud%20de%20soporte&body=Detalle%20su%20consulta%20o%20problema%20aquí',
        'meta' => [
        'target' => 'sitepoint'
        ]
    ]);

}

add_action( 'admin_bar_menu', 'bar_nenu_custom', 998 );
function bar_nenu_custom( $wp_admin_bar ) {
	
	$wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('view-site');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('add');

}

add_action('wp_head', 'add_keyword');
function add_keyword() {
	
	?>

		<meta name="uptimerobot" content="<?php echo $uptime_id; ?>">
		<script async defer data-website-id="<?php echo $track_id; ?>" src="https://analytics.uvcoding.com.ar/umami.js"></script>
	
	<?php

}

add_action('wp_head', 'add_lang_flag_on_mobile');
function add_lang_flag_on_mobile() {

	?>

		<script>

			jQuery(document).ready(function( $ ) 
			{
				let div = document.getElementById("uvlang");

				div.innerHTML = "";

				console.log(" > Detected lang.: " + page[0].lang );			
			} );
			
		</script>
	
	<?php

}

add_action('wp_dashboard_setup', 'add_uv_widget');
function add_uv_widget()
{
	wp_add_dashboard_widget('id_uv_widget', 'UVCoding Services', 'show_uv_widget');
}
function show_uv_widget()
{
	?>
		<ul>
			<li>
				<a href="mailto:info@uvcoding.com.ar?subject=Solicitud%20de%20soporte&body=Detalle%20su%20consulta%20o%20problema%20aquí">
					Contactar con servicio técnico
				</a>
			</li>
			<li>
				<a href="<?php echo $umami_url; ?>" target="_blank">
					Ver estadisticas de visita del sitio
				</a>
			</li>
			<li>
				<a href="https://uvcoding.com.ar" target="_blank">
					Visitar uvcoding.com.ar
				</a>
			</li>
		</ul>
	<?php
}
