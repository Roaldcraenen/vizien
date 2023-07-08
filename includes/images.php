<?php

// Images

// SET AND UNSET IMAGE SIZES
// Define custom image sizes
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    // set_post_thumbnail_size( 220, 160, true );
    // add_image_size('large',1920, 9999, false );
    // add_image_size('groot',1920, 9999, false );
    // add_image_size('square',240, 240, true );
    add_image_size('klein', 450, 9999);
    add_image_size('gemiddeld', 768, 9999);
    add_image_size('groot', 1024, 9999);
    add_image_size('full', 1920, 9999);
}

// Remove default image sizes
add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );
function prefix_remove_default_images( $sizes ) {
    
    // Unset default presets
    unset( $sizes['small']); // 150px
    unset( $sizes['medium']); // 300px
    unset( $sizes['medium_large']); // 768px
    unset( $sizes['large']); // 1024px

    // Unset other cropped resolutions
    unset( $sizes['1536x1536'] );
    unset( $sizes['2048x2048'] );

    return $sizes;
}

// JPEG compression quality
function my_prefix_regenerate_thumbnail_quality() {
    return 80;
}
add_filter( 'jpeg_quality', 'my_prefix_regenerate_thumbnail_quality');

// Overwrite default image width threshold of 2560px
// function custom_image_threshold( $threshold ) {
//    return 1920; // max image width (pixels)
// }
// add_filter('big_image_size_threshold', 'custom_image_threshold', 999, 1);

// Disable Big Image Size Threshold function
add_filter( 'big_image_size_threshold', '__return_false' );

function replace_uploaded_image($image_data) {
    // if there is no full image : return
    if (!isset($image_data['sizes']['full'])) return $image_data;

    // paths to the uploaded image and the full image
    $upload_dir = wp_upload_dir();
    $uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
    $large_image_filename = $image_data['sizes']['full']['file'];

    // Do what wordpress does in image_downsize() ... just replace the filenames ;)
    $image_basename = wp_basename($uploaded_image_location);
    $large_image_location = str_replace($image_basename, $large_image_filename, $uploaded_image_location);

    // Delete the uploaded image
    unlink($uploaded_image_location);

    // Rename the full image
    rename($large_image_location, $uploaded_image_location);

    // Update image metadata and return them
    $image_data['width'] = $image_data['sizes']['full']['width'];
    $image_data['height'] = $image_data['sizes']['full']['height'];
    unset($image_data['sizes']['full']);

    // Check if other size-configurations link to the full-file
    foreach($image_data['sizes'] as $size => $sizeData) {
        if ($sizeData['file'] === $large_image_filename)
            unset($image_data['sizes'][$size]);
    }
    return $image_data;
}
add_filter('wp_generate_attachment_metadata', 'replace_uploaded_image');

// Disable WordPRess responsive srcset images
// add_filter('max_srcset_image_width', create_function('', 'return 1;'));

?>