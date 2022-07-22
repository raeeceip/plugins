<?php
/**
 * Plugin Name:       Perzi
 * Description:       Uses REST API to extend functionality of perzi platform onto Wordpress.
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
<form action="menu_page.php" style=" background-color: white; display: inline-block;padding: 10px; border-radius: 10px; margin: 10px 10px 10% 35%; align-self: middle; text-align: center;color: grey; width: 420px;" #ccc id="simple_contact_form__form">
  <div class="container" style="justify-content: center; width: 100%; ">
    <h1>Perzi</h1>
    <p>Login/Signup</p>
    <hr>
    <div >
      <label for="email"><b>Email</b></label>
      <br/>
      <input type="text" placeholder="Enter Email" name="email" style="width:100%;" required>
    </div>

    <div>
      <label for="psw"><b>Password</b></label>
      <br/>
      <input type="password" placeholder="Enter Password" name="psw"  style="width:100%;" required>
    </div>

    <div>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <br/>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" style="width:100%; box-shadow: 4px 4px 5px 5px #88888;" required>
    </div>
      <br/>
    <div>
    <label>
      <input type="checkbox" checked="checked" name="remember" > Remember me
    </label>
    </div>


    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix" style="width=100%;">
      <button type="submit" class="signupbtn" style="padding:10px; border:1px solid gray; border-radius: 5px; background-color: yellow; width: 80%;">Sign Up</button>
</div>
  </div>
</form>
<?php


}

class SimpleContactForm{
  public function __construct()
  {
    add_action( 'init', array($this, 'create_posttype' ));

    add_action('init', array($this, 'create_custom_post_type'));
      /*
    add_action('wp_enqueue_scripts', array($this, 'load_assets'));
    */

    add_shortcode('contact-form', array($this, 'load_shortcode'));

    add_action('wp_footer', array($this, 'load_scripts'));

    add_action('rest_api_init', array($this, 'register_rest_api'));

   

    
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
  public function create_posttype() {
 
    register_post_type( 'Products',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Products'),
            'show_in_rest' => true,
 
        )
    );
}
  
  public function load_assets(){
    /*
    wp_enqueue_style(
        'simple-contact-form-style', 
        plugin_dir_url(__FILE__).'CSS/simple-contact-form.css',
        array(),
        '1.0.0',
        'all');
    */
    wp_enqueue_script('simple-contact-form-script',
        plugin_dir_url(__FILE__).'JS/simple-contact-form.js',
        array('jQuery'),
        '1.0.0',
        true);
  }
  

  public function load_shortcode(){
    return '

  <div class="simple-contact-form" style=" background-color: blue; display: inline-block;padding: 10px; border-radius: 10px; margin: 10px 10px 10% 35%; align-self: middle; text-align: center;color: grey; width: 420px;" #ccc id="simple_contact_form__form" >
    <h1>Contact us</h1>
    <form id="simple-contact-form__form ">
    <div class="form-group mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <br/>
      <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
      
    </div>

    <div class="form-group mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <br/>
      <input type="text-area" class="form-control" id="InputPassword1">
    </div>
    <button type="submit" class="btn btn-success btn-block w-100">Submit</button>
  </form>

  </div>
    
    '

      

    ;

    
   }
   public function load_scripts()
   {?>
      <script src="http://code.jquery.com/jquery-1.11.3.min.js">
        (function($){
          $(document).ready(function(){
            $('#simple-contact-form__form').on('submit', function(e){
              e.preventDefault();
              var form = $(this);
              var formData = $(this).serialize();
              $.ajax({
                url: '<?php echo get_rest_url(null, null); ?>',
                method: 'POST',
                data: formData,
                headers: {
                  'X-WP-Nonce': '<?php echo wp_create_nonce('wp_rest'); ?>'
                },
                success: function(data){
                  console.log(data);
                  form.trigger('reset');
                }
              });
            });
          });
        })(jQuery);
      </script>

   <?php
   }
   public function register_rest_routes()
   {
    register_rest_route('simple-contact-form/v1', 'send-email', array(
      'methods' => 'POST',
      'callback' => array($this, 'handle_contac_form')
    ));
   }
   public function handle_contac_form($request)
   {
    $email = $request->get_param('email');
    $message = $request->get_param('message');
    $name = $request->get_param('name');
    $subject = $request->get_param('subject');
    $to = '
    <div>
      <h1>'.$name.'</h1>
      <p>'.$message.'</p>
    </div>
    ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $to, $headers);
    return new WP_REST_Response(array('message' => 'Email sent successfully'), 200);
   }

}

new SimpleContactForm;
