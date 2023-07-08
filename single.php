<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php echo get_template_part('parts/breadcrumbs'); ?>

    <?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); ?>
    <?php $feat_image_srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id( $post->ID )); ?>
    <?php $positie = get_field('positie'); ?>
        <?php if($feat_image != null) { ?>
            <div class="page-header">
                <img src="<?php echo $feat_image[0]; ?>" style="object-position:50% <?php if($positie) { echo $positie;?>%<?php } else { ?>50%<?php } ?>" srcset="<?php echo $feat_image_srcset; ?>" sizes="(max-width: 1920px) 100vw, 1920px" alt="<?php the_title(); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div> 
                </div>
            </div>
        <?php } else { ?>
            <div class="page-header-alt">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div> 
                </div>
            </div>
        <?php } ?>

    <!-- Non-featured afbeelding met srcset -->
    <?php //$over_img = $over['afbeelding']; ?>
    <?php //$over_srcset = wp_get_attachment_image_srcset( $over_img['ID'] ); ?>
    <!-- <img src="<?php //echo $over['afbeelding']['sizes']['full']; ?>" width="696" height="512" srcset="<?php //echo $over_srcset; ?>" sizes="(max-width: 1920px) 100vw, 1920px" /> -->

    <div class="page-content p-60-90">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="titels">
                        <span><?php the_title(); ?></span>
                        <h1><?php echo $titel; ?></h1>
                    </div>
                    <div class="main-content">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="page-widget">
                        <h4><?php //echo $widget['titel']; ?></h4>
                        <?php //echo $widget['tekst'] ;?>
                        <a class="btn-blauw shadow transition hover up icon-right" href="<?php //echo $widget['knop_url']; ?>"><?php //echo $widget['knop_tekst']; ?><i class="far fa-chevron-circle-right padding-left transition"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>