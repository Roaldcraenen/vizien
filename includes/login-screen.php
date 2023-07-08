<?php

// Custom login screen

function custom_login_screen() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a{background-image: url('<?php bloginfo('template_directory');?>/images/login-logo.svg');height:39px; width:200px;background-size: 200px 39px;background-repeat: no-repeat;object-fit: contain;pointer-events: none;}body.login{background-image: url('<?php bloginfo('template_directory');?>/images/login-bg.png')!important;background-repeat: no-repeat;background-position: bottom center;background-size: 100% auto;background-blend-mode: overlay;}
    </style> 
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_screen' );

?>