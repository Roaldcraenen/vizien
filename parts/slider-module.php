<div class="slider-module p-90">
	<div class="container">
		<div class="row">
			
			<div class="custom-slider-wrapper position-relative">
                    <div class="custom-slider">
                        <div class="swiper-wrapper">
                            <?php $check = array($post->ID); 
                            $loop = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' )); 
                            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                
                                <div class="swiper-slide">
                                    <div class="swiper-item clickable transition hover">
                                        
                                        <!-- Content hier -->
                                        <!-- 
                                            Layout (lib.js):
                                            Mobiel:     1.4 slides per view (gradient overlay rechts, géén navigatieknoppen)
                                            Tablet:     2.4 slides per view (gradient overlay rechts, géén navigatieknoppen)
                                            Desktop:    2   slides per view (géén gradient overlay, navigatieknoppen)
                                        -->

                                    </div>
                                </div>

                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    
                    <!-- Navigation (alleen zichtbaar vanaf 992px) -->
                    <div class="swiper-button-prev shadow"></div>
                    <div class="swiper-button-next shadow"></div>

                    <!-- Pagination -->
                    <!-- <div class="swiper-pagination"></div> -->

                </div>

		</div>
	</div>
</div>