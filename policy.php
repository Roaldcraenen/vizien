<?php /* Template Name: Policy */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php echo get_template_part('parts/breadcrumbs-alt'); ?>

<div class="page-content policy-content p-60-90">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="titels">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="main-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>