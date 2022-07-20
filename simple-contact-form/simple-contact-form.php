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
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<style type="text/css">
	body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.main{
	width: 350px;
	height: 500px;
	background: yellow;
	overflow: hidden;
 
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

</style>
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form>
					<label for="chk" aria-hidden="true">Wecome To Perzi</label>
					<input type="text" name="txt" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
</body>
</html>
<?php


}

class SimpleContactForm{
  public function __construct()
  {
    add_action('init', array($this, 'create_custom_post_type'));

    add_action('wp_enqueue_scripts', array($this, 'load_assets'));

    add_shortcode('contact_form', array($this, 'load_shortcode'));

    
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
      return '
    <div class="col-lg-6 col-6 pd-l">
      [text* your-name placeholder"Name"]
      [text* your-sub placeholder"subject"]
    </div>
    <div class="col-lg-6 col-12 pd-r">
      [email* your-email placeholder"Email"]
      [tel* tel-672 your-phone placeholder"Phone"]
    </div>
    <div class="col-12">
      [textarea your-message placeholder"message"]
    </div>
    <div class="col-12 btn-sub">[submit "Send"]</div>';
  }

}

new SimpleContactForm;
