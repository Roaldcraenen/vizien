<?php get_header(); ?>

<!-- Hero -->
<div class="hero activiteit">
	<div class="hero-img" style="background-image:url(<?php echo get_stylesheet_directory_uri();?>/images/hero.jpg)"></div>
    <div class="hero-txt">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><?php single_cat_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Content -->
<?php if ( '' != category_description() ) { ;?>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<?php echo apply_filters('archive_meta', category_description()); ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php } ?>

<!-- Activiteiten -->
<div class="activiteiten">
	<div class="container">
		<div class="row">
			<?php
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID;
			?>

			<?php
			$args = array(
				'post_type' => 'activiteit',
				'cat' => $cat_id
			);

			$my_query = new WP_Query( $args );

			if( $my_query->have_posts() ) {
			    while ($my_query->have_posts()) : $my_query->the_post(); ?>
			        <!-- <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>< -->
			        <?php
					$image = get_field('activiteit_slider');
					// $image = $image[0]['activiteit_slider_afbeelding'];
					$image = wp_get_attachment_image_src($image[0]['activiteit_slider_afbeelding'],'large');
					?>
					<div class="col-md-4">
						<div class="activiteit" onclick="location.href='<?php the_permalink();?>';">
							<div class="img" style="background-image:url(<?php echo $image[0];?>)">
								<?php 
								$prijs = get_field('activiteit_prijs');
								$prijs = explode(",", $prijs);
								?>
								<!-- <div class="price"><?php echo "&plusmn;".$prijs[0].",- pp";?></div> -->
								<div class="price"><?php echo $prijs[0].",- pp";?></div>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<a class="more text-center" href="<?php the_permalink(); ?>">Meer informatie<i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
			  <?php endwhile;
			}
			wp_reset_query();
			?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php get_template_part('nav', 'below'); ?>
			</div>
		</div>
	</div>	
</div>

<?php get_footer(); ?>