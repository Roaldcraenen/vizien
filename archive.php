<?php get_header(); ?>

<!-- Breadcrumbs -->
<?php echo get_template_part('parts/breadcrumbs'); ?>

<!-- Tekst boven grid -->
<?php $tekst = get_field('','options'); ?>

<!-- Reviews/referenties -->
<?php $score = get_field('score'); ?>
<?php $score = checkReview(); ?>

<div class="page-content custom-archive p-60-66">
    <div class="container">

    	<!-- Titel + subtitel -->
        <div class="row">
            <div class="col-12">
                <div class="titels">
                    <span>Titel hier</span>
                    <h1><?php echo $tekst['titel']; ?></h1>
                </div>
            </div>
        </div>

        <!-- Tekst + gemiddeld cijfer -->
        <div class="row align-items-start justify-content-lg-between text-row">
            <div class="col-12 col-lg-8">
                <div class="main-content">
                    <?php echo $referentie['tekst']; ?>
                </div>
            </div>
            <div class="col-12 col-lg-auto d-flex justify-content-start justify-content-lg-end">
                <div class="cijfer-wrapper d-flex flex-column align-items-center justify-content-center">
                    <span class="gemiddelde d-inline-flex justify-content-center align-items-center">
                        <?php echo $score['score_html']; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Alleen tekst -->
        <div class="row align-items-start text-row">
            <div class="col-12 col-lg-7">
                <div class="main-content">
                    <?php echo $cases['tekst']; ?>
                </div>
            </div>
        </div>

        <!-- Filter op categorieën -->
        <div class="row filter-row">
            <div class="col-12">
               <h4>Filter op:</h4>
               <div class="filters-wrapper d-block">
                   <div class="filters d-inline">

                   	   <!-- Standaard categorie -->
                       <?php foreach((get_categories( array('hide_empty' => true, 'taxonomy' => 'category')) ) as $category): ?>
                           <a href="#<?php echo $category->slug; ?>" class="filter-btn"><?php echo $category->name; ?></a>
                       <?php endforeach; ?>

                       <!-- Custom taxonomy (functions.php) -->
                       <?php foreach((get_categories( array('hide_empty' => true, 'taxonomy' => 'label')) ) as $category): ?>
                           <a href="#<?php echo $category->slug; ?>" class="filter-btn"><?php echo $category->name; ?></a>
                       <?php endforeach; ?>

                   </div>
                   <div class="reset-wrap d-inline">
                       <a href="#" class="reset"><i class="fas fa-times"></i></a>   
                   </div>
               </div>
            </div>
        </div>

        <!-- Referenties Grid (3 rijen + Masonry) -->
        <div class="row">
            <div class="referentie-archief">
                <div class="wrapper">
                    <div class="row grid">
                    <div class="grid-sizer col-12 col-md-6 col-lg-4"></div>
                        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $loop = new WP_Query( array( 'post_type' => 'referenties', 'posts_per_page' => -1, 'paged' => $paged ) ); 
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="grid-item col-12 col-md-6 col-lg-4">
                                <div class="referentie-wrapper shadow">
                                    <div class="rating d-flex flex-row align-items-center">
                                        <div class="stars">
                                            <?php $rating = get_field('ref_score') / 2;
                                                for($x=1;$x<=$rating;$x++) {
                                                    echo '<i class="fas fa-star"></i>';
                                                }
                                                if (strpos($rating,'.')) {
                                                    echo '<i class="fas fa-star-half-alt"></i>';
                                                    $x++;
                                                }
                                                while ($x<=5) {
                                                    echo '<i class="far fa-star"></i>';
                                                    $x++;
                                                } ?>
                                        </div>
                                        <div class="meta"><?php echo get_the_date('d-m-Y'); ?></div>
                                    </div>
                                    <div class="content">
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="author d-flex flex-row align-items-center">
                                        <?php $img = get_field('ref_afbeelding'); ?>
                                        <div class="img-wrapper">
                                            <?php if($img) { ?>
                                                <img src="<?php echo $img; ?>" width="60" height="60" alt="<?php echo get_the_title(); ?>" />
                                            <?php } else { ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default-user-image.svg" width="60" height="60" alt="<?php echo get_the_title(); ?>" />
                                            <?php } ?>
                                        </div>
                                        <div class="content">
                                            <?php $bdf = get_field('ref_bedrijf'); ?>
                                            <div class="naam"><?php echo get_the_title(); ?></div>
                                            <div class="bedrijf"><?php echo $bdf; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Archief (4 rijen) -->
        <div class="row">
            <div class="nieuws-archief">
                <div class="wrapper">
                    <!-- <div class="row grid"> -->
                    <!-- <div class="grid-sizer col-12 col-md-6 col-lg-3"></div> -->
                        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $loop = new WP_Query( array( 'post_type' => 'nieuws', 'posts_per_page' => -1, 'paged' => $paged ) ); 
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        	<!-- Standaard categorie -->
                            <?php $category_name = array(); ?>
                            <?php foreach((get_the_category($post->ID,'category')) as $category){ 
                                $category_name[]=$category->slug; 
                            } ?>

                            <!-- Custom taxonomy (functions.php) -->
                            <?php $category_name = array(); ?>
                            <?php foreach((get_the_terms($post->ID,'label')) as $category){ 
                                $category_name[]=$category->slug; 
                            } ?>

                            <div class="col-12 col-md-6 col-lg-3">
                            <!-- <div class="grid-item col-12 col-md-6 col-lg-3 <?php echo implode(' ',$category_name); ?>"> -->
                                <?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); ?>
                                
                                <div class="nieuws-item clickable transition up shadow">
                                    <div class="img-wrapper">
                                        <?php if ($feat_image){ ?>
                                            <img class="nieuws-img" alt="<?php echo get_the_title(); ?>" src="<?php echo $feat_image[0]; ?>" width="516" height="387" />
                                        <?php } else { ?>
                                            <img class="nieuws-img" alt="<?php echo get_the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/images/no-image.svg" width="516" height="387" />
                                        <?php } ?> 
                                        <?php if(get_the_category() != NULL): ?>
                                            <div class="tag-wrapper d-flex">

                                            	<!-- Standaard categorie -->
                                                <?php foreach((get_the_category($post->ID,'category')) as $category){ ?>
	                                                <div class="tag">
	                                                     <?php echo $category->name; ?>
	                                                </div>
                                                <?php } ?>

                                                <!-- Custom taxonomy (functions.php) -->
                                                <?php foreach((get_the_terms($post->ID,'label')) as $category){ ?>
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

                       </div> 
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                 </div>
            </div>

    </div>
</div>


<?php get_footer(); ?>