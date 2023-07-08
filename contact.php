<?php /* Template Name: Contact */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php $adres = get_field('bedrijfsgegevens','option'); ?>

<?php echo get_template_part('parts/breadcrumbs'); ?> 

<div class="page-content p-60-90">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="titels">
                    <span><?php echo $contact['subtitel']; ?></span>
                    <h1><?php echo $contact['titel']; ?></h1>
                </div>
                <div class="main-content">
                    <?php echo the_content(); ?>
                </div>
                <div class="contact-form">
                    <?php echo do_shortcode( '[contact-form-7 id="5" title="Contactformulier"]' ); ?>
                </div>
            </div>
            <div class="col-12 col-lg-4 offset-lg-1">
                <div class="page-widget contact-widget">
                    <h4>Adres</h4>
                    <p>
                        <?php echo $adres['straat']." ".$adres['huisnummer']; ?><br>
                        <?php echo $adres['postcode']." ".$adres['plaats']; ?><br>
                        <a href="mailto:<?php echo $adres['email']; ?>"><i class="far fa-envelope padding-right"></i><?php echo $adres['email']; ?></a>
                        <a href="tel:<?php echo $adres['telefoon']; ?>"><i class="fas fa-phone-alt padding-right"></i><?php echo $adres['telefoon']; ?></a>
                    </p>
                    <a class="btn-blauw-dun transition hover up icon-right" target="_blank" href="<?php echo $contact['route']; ?>">Routebeschrijving<i class="far fa-chevron-circle-right padding-left transition"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>



<!-- ********** OUD ********** -->

    <?php// $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'groot' ); ?>
    <!-- Header -->
    <!-- <div class="header" style="background-image:url('<?php //echo $feat_image; ?>')">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2><?php //the_title(); ?></h2>
                </div>
            </div> 
        </div>
    </div> -->

    <!-- Main text -->
    <!-- <div class="main blok half">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="txt">
                        <?php //the_content(); ?>
                    </div>
                </div>
                
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="sidebar">
                        <div class="widget normal adres">
                            <?php //$adres = get_field('adresgegevens','option'); ?>
                            <h3>Adres</h3>
                            <p>
                                <?php //echo $adres['straat']." ".$adres['huisnummer']; ?><br>
                                <?php //echo $adres['postcode']." ".$adres['plaats']; ?><br>
                                <?php //echo $adres['land']; ?><br>
                                <span><i class="fas fa-envelope padding-right"></i><a href="mailto:<?php //echo $adres['email']; ?>"><?php //echo $adres['email']; ?></a><br></span>
                                <span><i class="fas fa-phone-alt padding-right"></i><a href="tel:<?php //echo $adres['telefoonnummer']; ?>"><?php //echo $adres['telefoonnummer']; ?></a></span>
                            </p>
                            <div class="social mb-4 mb-lg-0">
                                <?php //$social = get_field('social','option'); ?>
                                <?php //foreach ($social as $s): ?>
                                    <a class="transition hover up pointer" target="_blank" href="<?php //echo $s['url']; ?>"><?php //echo $s['icoon']; ?></a>
                                <?php //endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<?php //endwhile; endif; ?>

<?php //get_footer(); ?>