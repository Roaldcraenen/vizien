<?php 

// Contact Form 7

// Set CF7 referrer URL
function getRefererPage( $form_tag )
{
    if ( $form_tag['name'] == 'referer-page' ) {
        $path = parse_url(htmlspecialchars($_SERVER['HTTP_REFERER']), PHP_URL_PATH);
        if ($path == '/vacatures/') {
            $form_tag['values'][] = 'Open Sollicitatie';
        } else {
            $form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
        }
    }
    return $form_tag;
}
if ( !is_admin() ) {
    add_filter( 'wpcf7_form_tag', 'getRefererPage' );
}

// Contact Form 7 DOM Events
add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    var formname = 'form-' + event.detail.contactFormId;
    // ga( 'send', 'event', formname, 'send' ); // analytics.js
    gtag( 'event', 'send', { // gtag.js
        'event_category': formname
    });
}, false );
</script>
<?php
}

?>