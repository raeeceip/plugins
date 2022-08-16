<?php
/**
 * Plugin Name:       Perzi
 * Description:       Adding functionality of Perzi platform onto Wordpress.
 * Version:           1.0.0
 * Author:            Chibogu Chisom
 * Text Domain:       simple-contact-form

 */



if(!defined('ABSPATH'))
{
    echo 'You are not allowed to call this page directly.';
    exit;
}



add_action('admin_menu', 'function_create_menu');

// Create WordPress admin menu
function function_create_menu(){



//The icon in the data URI scheme
$icon_data_uri = 'dashicons-products' ;

$page_title = 'Hello World';
$menu_title = 'Perzi Admin';
$icon_data_uri;
$position   = '5';
$capability = 'manage_options';
$menu_slug  = 'newPage';
$function   = 'test_page';

add_menu_page(
    $page_title,
    $menu_title,
    $capability,
    $menu_slug,
    $function,
    $icon_data_uri,
    $position
);

add_submenu_page(
    'newPage',
    'Contact Page',
    'Contact Us', 
    $capability,
    'sub-page',
    'contact_page'
    
  

);
add_submenu_page(
    'newPage',
    'Manage Posts',
    'Manage Posts',
    $capability,
    'edit.php?post_type=CPT',
    'create_custom_post_type'   

  

);

}
function test_page()
{
/* load html template */
$pageHTML = file_get_contents(plugin_dir_path(__FILE__) . '/html/signup.html');

echo $pageHTML;


}

add_action( 'wp_enqueue_scripts', 'test_page' );

function contact_page(){
  $pageHTML = file_get_contents(plugin_dir_path(__FILE__) . '/html/contactus.html');

  echo $pageHTML;

}
// Hook our function to WordPress the_con function to display the content 
add_action( 'wp_enqueue_scripts', 'contact_page' );



function create_custom_post_type()
  {
        $args = array(
            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'slug' => 'edit.php?post_type=CPT',
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability'=> 'manage_options',
            'labels' => array(
                'name' => 'Migrate',
                'singular_name' => 'Migrate Entry',
            ),

            'menu_icon' => 'dashicons-media-text',

        );
        register_post_type('simple_contact_form', $args);
  }

  


  
