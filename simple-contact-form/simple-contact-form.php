<?php
/**
 * Plugin Name:        Simple Contact Form
 * Description:       Extends the WP REST API for Developing a Simple Contact Form.
 * Version:           1.0.0
 * Author:            Chibogu Chisom
 * Text Domain:       simple-contact-form

 */



if(!defined('ABSPATH'))
{
    echo 'You are not allowed to call this page directly.';
    exit;
}

class SimpleContactForm{
  public function __construct()
  {
    add_action('init', array($this, 'create_custom_post_type'));

    add_action(wp_enqueue_scripts, array($this, 'load_assets'));
  }
  public function create_custom_post_type()
  {
        $args = array(
            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability'=> 'manage_options',
            'labels' => array(
                'name' => 'Contact Form',
                'singular_name' => 'Contact Form Entry',
            ),

            'menu_icon' => 'dashicons-media-text',

        );
        register_post_type('simple_contact_form', $args);
  }
  public function load_assets(){
    wp_enqueue_style(
        'simple-contact-form-style', 
        plugin_dir_url(__FILE__).'CSS/simple-contact-form.css',
        array(),
        '1.0.0',
        'all');
    wp_enqueue_script('simple-contact-form-script',
        plugin_dir_url(__FILE__).'JS/simple-contact-form.js',
        array('jquery'),
        '1.0.0',
        true);
  }
}

new SimpleContactForm;
