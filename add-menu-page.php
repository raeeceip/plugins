<?php
/*extends simplecontactform_admin_menu()*/
function simplecontactform_add_menu_page() {
    add_menu_page(
        'Simple Contact Form',
        'Simple Contact Form',
        'manage_options',
        'simple-contact-form',
        'simplecontactform_admin_page_callback',
        'dashicons-email',
        3
    );
}
add_action('admin_menu', 'simplecontactform_add_menu_page');
?>



