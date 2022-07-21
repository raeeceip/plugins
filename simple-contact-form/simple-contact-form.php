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



add_action('admin_menu', 'function_create_menu');
// Create WordPress admin menu
function function_create_menu(){

//The icon in Base64 format
$icon_base64 = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj48c3ZnIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAyMTM0IDIxMzQiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM6c2VyaWY9Imh0dHA6Ly93d3cuc2VyaWYuY29tLyIgc3R5bGU9ImZpbGwtcnVsZTpldmVub2RkO2NsaXAtcnVsZTpldmVub2RkO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoxLjU7Ij48Zz48cmVjdCB4PSIyODIuNTc2IiB5PSI4OTAuODg2IiB3aWR0aD0iNzc1Ljc1OCIgaGVpZ2h0PSI3NzguNzgxIiBzdHlsZT0iZmlsbDojZmZmO2ZpbGwtb3BhY2l0eTowO3N0cm9rZTojMDAxZGZmO3N0cm9rZS13aWR0aDo2Ni42N3B4OyIvPjxyZWN0IHg9IjEwNzMuODkiIHk9Ijg5MC44ODYiIHdpZHRoPSI3NzUuNzU4IiBoZWlnaHQ9Ijc3OC43ODEiIHN0eWxlPSJmaWxsOiNmZmY7ZmlsbC1vcGFjaXR5OjA7c3Ryb2tlOiMwMDFkZmY7c3Ryb2tlLXdpZHRoOjY2LjY3cHg7Ii8+PHJlY3QgeD0iNjc4LjIzMiIgeT0iMTA2LjUzNyIgd2lkdGg9Ijc3NS43NTgiIGhlaWdodD0iNzc4Ljc4MSIgc3R5bGU9ImZpbGw6I2ZmZjtmaWxsLW9wYWNpdHk6MDtzdHJva2U6IzAwMWRmZjtzdHJva2Utd2lkdGg6NjYuNjdweDsiLz48cGF0aCBkPSJNMTE3My43MywzMy4zNjZsLTIxNS4yOTEsLTBsLTAsMzY3LjI0MWwxMDcuMTMxLC0xMTkuMTA2bDEwOC4xNiwxMTkuMTA2bC0wLC0zNjcuMjQxWiIgc3R5bGU9ImZpbGw6I2ZmZjtmaWxsLW9wYWNpdHk6MDtzdHJva2U6IzAwMWRmZjtzdHJva2Utd2lkdGg6NjYuNjdweDsiLz48cGF0aCBkPSJNNzgxLjg0OCw4OTQuMDc1bC0yMTUuMjkxLDBsLTAsMzUzLjc3MWwxMDcuMTMxLC0xMTQuNzM3bDEwOC4xNiwxMTQuNzM3bC0wLC0zNTMuNzcxWiIgc3R5bGU9ImZpbGw6I2ZmZjtmaWxsLW9wYWNpdHk6MDtzdHJva2U6IzAwMWRmZjtzdHJva2Utd2lkdGg6NjYuNjdweDsiLz48cGF0aCBkPSJNMTU2NC45OCw4OTUuNDc0bC0yMTUuMjkxLC0wbC0wLDM1My43NzFsMTA3LjEzLC0xMTQuNzM3bDEwOC4xNjEsMTE0LjczN2wtMCwtMzUzLjc3MVoiIHN0eWxlPSJmaWxsOiNmZmY7ZmlsbC1vcGFjaXR5OjA7c3Ryb2tlOiMwMDFkZmY7c3Ryb2tlLXdpZHRoOjY2LjY3cHg7Ii8+PHJlY3QgeD0iOTk2LjMwMiIgeT0iNTAxLjQ5NyIgd2lkdGg9IjEzOS41NjEiIGhlaWdodD0iNjQuMjMxIiBzdHlsZT0iZmlsbDojMDAxZGZmO3N0cm9rZTojMDAxZGZmO3N0cm9rZS13aWR0aDoxMS42M3B4OyIvPjxyZWN0IHg9IjYwNC40MjIiIHk9IjEzNTUuODkiIHdpZHRoPSIxMzkuNTYxIiBoZWlnaHQ9IjY0LjIzMSIgc3R5bGU9ImZpbGw6IzAwMWRmZjtzdHJva2U6IzAwMWRmZjtzdHJva2Utd2lkdGg6MTEuNjNweDsiLz48cmVjdCB4PSIxMzg3LjU1IiB5PSIxMzU1Ljg5IiB3aWR0aD0iMTM5LjU2MSIgaGVpZ2h0PSI2NC4yMzEiIHN0eWxlPSJmaWxsOiMwMDFkZmY7c3Ryb2tlOiMwMDFkZmY7c3Ryb2tlLXdpZHRoOjExLjYzcHg7Ii8+PHJlY3QgeD0iMTQxLjAzOCIgeT0iMTY3MS4yOCIgd2lkdGg9IjE4NDcuMDMiIGhlaWdodD0iMTQyLjg0IiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAxZGZmO3N0cm9rZS13aWR0aDo2Ni42N3B4OyIvPjxyZWN0IHg9IjE0MC4wMDMiIHk9IjE5NTUuNDMiIHdpZHRoPSIxODQ5LjEiIGhlaWdodD0iMTQyLjg0IiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAxZGZmO3N0cm9rZS13aWR0aDo2Ni42N3B4OyIvPjxyZWN0IHg9IjIxMy4yMzYiIHk9IjE4MTMuNyIgd2lkdGg9IjE0Mi40MTIiIGhlaWdodD0iMTQxLjQ3OSIgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6IzAwMWRmZjtzdHJva2Utd2lkdGg6NjYuNjdweDsiLz48cmVjdCB4PSI5OTUuOTIxIiB5PSIxODEzLjciIHdpZHRoPSIxNDIuNDEyIiBoZWlnaHQ9IjE0MS40NzkiIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlOiMwMDFkZmY7c3Ryb2tlLXdpZHRoOjY2LjY3cHg7Ii8+PHJlY3QgeD0iMTc3OC42MSIgeT0iMTgxMy43IiB3aWR0aD0iMTQyLjQxMiIgaGVpZ2h0PSIxNDEuNDc5IiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAxZGZmO3N0cm9rZS13aWR0aDo2Ni42N3B4OyIvPjwvZz48L3N2Zz4=';

//The icon in the data URI scheme
$icon_data_uri = 'dashicons-products' ;

$page_title = 'Hello World';
$menu_title = 'Perzi Admin';
$icon_data_uri;
$position   = '20';
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

}

function test_page()
{
?>
<form action="menu_page.php" style="border:1px solid #ccc id="simple_contact_form__form"">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php


}

class SimpleContactForm{
  public function __construct()
  {
    add_action('init', array($this, 'create_custom_post_type'));

    add_action('wp_enqueue_scripts', array($this, 'load_assets'));

    add_shortcode('contact-form', array($this, 'load_shortcode'));

    
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

  public function load_shortcode(){
    ?>
      <div class="simple-contact-form" >
          <h1>Contact us</h1>
          <form id="simple-contact-form__form ">
          <div class="form-group mb-2">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            
          </div>

          <div class="form-group mb-2">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" class="btn btn-success btn-block w-100">Submit</button>
        </form>
      
      </div>
      <?php
    

  
   }

}

new SimpleContactForm;
