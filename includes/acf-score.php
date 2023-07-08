<?php

// ACF score

// CheckReview based on custom post type
function checkReview() {
    $score =  $i = 0;
    $args = array(
        'post_type' => 'referenties',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    $myposts = new WP_Query( $args );
    if ( $myposts->have_posts() ){
        while ( $myposts->have_posts() ) {
            $i++;
            $myposts->the_post();
            $score += get_field('score',get_the_ID());
            //$score += get_field('review',get_the_ID())['score'];
        }
        wp_reset_postdata();
    }

    $score = number_format(($score / $i),1,",",".");
    
    $score_html = explode(",", $score);
    $score_html = $score_html[0].",<sup>".$score_html[1]."</sup>";

    return array("score" => $score, "score_html" => $score_html, "aantal" => $i);
}

// CheckReview based on ACF field
function checkReviewACF() {
    // $reviews = get_field('referenties',2);
    $reviews = array(array("score" => '9'),array("score" => '9'),array("score" => '9'));
    $aantal = sizeof($reviews);
    $score = 0;

    foreach ($reviews as $review) {
        $score += $review['score'];
    }
    // $score = $score * 2;

    $score = number_format(($score / $aantal),1,",",".");
    
    $score_html = explode(",", $score);
    $score_html = $score_html[0].",<sup>".$score_html[1]."</sup>";

    return array("score" => $score, "score_html" => $score_html, "aantal" => $aantal);
}

?>