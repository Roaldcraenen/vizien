<div class="cpt-module p-90">
	<div class="container">
		
		<div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-8">
                <div class="module-titels">
                    <span>Actueel</span>
                    <h3>Onze laatste artikelen</h3>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-none d-lg-flex justify-content-end">
                <a class="btn-blauw-min transition hover icon-right" href="/nieuws/">Bekijk alle artikelen<i class="far fa-angle-right padding-left transition"></i></a>
            </div>
        </div>

        <div class="row">
            <?php $check = array($post->ID); 
            $loop = new WP_Query( array( 'post_type' => 'nieuws', 'posts_per_page' => 4, 'post__not_in' => $check )); 
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="col-12 col-md-6 col-lg-3 nieuws-col">
                    <?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); ?>
                    <div class="nieuws-item clickable transition up shadow">
                        <div class="img-wrapper">
                            <?php if ($feat_image){ ?>
                                <img class="nieuws-img" alt="<?php echo get_the_title(); ?>" src="<?php echo $feat_image[0]; ?>" width="516" height="387" />
                            <?php } else { ?>
                                <img class="nieuws-img" alt="<?php echo get_the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/images/fallback-small.jpg" width="516" height="387" />
                            <?php } ?> 
                            <?php if($cat = get_the_category() ) : ?>
                                <div class="tag-wrapper d-flex">
                                    <?php foreach((get_the_category($post->ID,'category')) as $category){ ?>
                                     <div class="tag">
                                         <?php echo $category->name; ?>
                                     </div>
                                    <?php } ?>
                                </div> 
                            <?php endif; ?>   
                        </div>
                        <div class="content-wrapper">
                            <span class="meta"><?php echo get_the_date(); ?></span>
                            <a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        
        <div class="row button-row d-flex d-lg-none">
            <div class="col-12 col-lg-4 d-flex justify-content-end">
                <a class="btn-blauw-min transition hover icon-right" href="/nieuws/">Bekijk alle artikelen<i class="far fa-angle-right padding-left transition"></i></a>
            </div>
        </div>

	</div>
</div>