<?php /* Template Name: Sitemap */ ?>

<?php get_header(); ?>

<?php echo get_template_part('parts/breadcrumbs'); ?>  

<div class="page-content policy-content p-60-90">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="titels">
                    <h1>Sitemap</h1>
                </div>
                <div class="main-content">
                    <h2>Pagina's</h2>
                    <ul>
                        <?php wp_list_pages(array('exclude' => '','title_li' => '','sort_column' => 'menu_order',)); ?>
                        <!-- <li><a href="/cases/">Cases</a></li>
                        <li><a href="/nieuws/">Nieuws</a></li>
                        <li><a href="/veelgestelde-vragen/">Veelgestelde vragen</a></li>
                        <li><a href="/team/">Team</a></li>
                        <li><a href="/referenties/">Referenties</a></li> -->
                    </ul>
                    <!-- <h2>Cases</h2>
                    <ul>
                        <?php $args = array('post_type' => 'cases','posts_per_page' => -1,'orderby' => 'title','order' => 'ASC','post_status' => 'publish');
                        $the_pages = new WP_Query( $args );

                        if( $the_pages->have_posts() ){
                            while( $the_pages->have_posts() ){
                                $the_pages->the_post();
                                ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
                            }
                        } 
                        wp_reset_postdata(); ?>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>



<!-- ********** OUD ********** -->

<?php //$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'groot' )[0]; ?>

<?php //if ($feat_image): ?>
    <!-- <div class="header" data-parallax="scroll" data-image-src="<?php //echo $feat_image; ?>" data-speed="0.7" style="background-image:url('')"></div> -->
<?php //endif; ?>

<!-- Main text -->
<!-- <div class="main left">
    <div class="right"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="txt">
                    <h1 class="titel"><?php //the_title(); ?></h1>
                    <ul>
                    <?php //wp_list_pages(array('exclude' => '','title_li' => '','sort_column' => 'menu_order',)); ?>
                    </ul>

                    <h2>Blog</h2>
                    <?php
                    // $cats = get_categories('exclude=');
                    // foreach ($cats as $cat) {
                    //     echo "<ul>";
                    //     query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
                    //     while(have_posts()) {
                    //         the_post();
                    //         $category = get_the_category();
                    //         if ($category[0]->cat_ID == $cat->cat_ID) echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                    //     }
                    //     echo "</ul>";
                    // }
                    ?>

                    <h2>Koffiebars</h2>
                    <ul>
                        <?php
                        // $args = array(
                        //     'post_type' => 'koffiebars',
                        //     'posts_per_page' => -1,
                        //     'orderby' => 'title',
                        //     'order' => 'ASC',
                        //     'post_status' => 'publish'
                        // );
                        // $the_pages = new WP_Query( $args );

                        // if( $the_pages->have_posts() ){
                        //     while( $the_pages->have_posts() ){
                        //         $the_pages->the_post();
                        //         ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
                        //     }
                        // }
                        // wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="inner">
                    <?php //get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php //get_footer(); ?>