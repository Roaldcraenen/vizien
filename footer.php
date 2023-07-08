<div class="footer p-90">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<a class="footer-logo" href="/">
					<img width="196" height="60" alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-wit.svg">
				</a>
				<?php $adres = get_field('bedrijfsgegevens','option'); ?>
				<div class="row">
					<div class="row">
						<div class="col-12 footer-bedrijf">
							<h4 class="naam"><?php echo $adres['bedrijfsnaam']; ?></h4>
						</div>
					</div>
					<div class="col-md-6 footer-adres">
						<p>
		                    <?php echo $adres['straat']." ".$adres['huisnummer']; ?><br>
		                    <?php echo $adres['postcode']." ".$adres['plaats']; ?>
	                    </p>
					</div>
					<div class="col-md-6 footer-contact">
						<p>
							<a href="mailto:<?php echo $adres['email']; ?>"><i class="fas fa-envelope padding-right"></i><?php echo $adres['email']; ?></a>
							<a href="tel:<?php echo $adres['telefoon']; ?>"><i class="fas fa-phone-alt padding-right"></i><?php echo $adres['telefoon']; ?></a>
						</p>
					</div>
				</div>
				<?php if($social = $adres['social_media']) :?>
					<div class="social footer-social">
						<?php foreach ($social as $item): ?>
						    <a href="<?php echo $item['url']; ?>" class="transition hover up pointer" target="_blank"><i class="fab <?php echo $item['platform']; ?>"></i></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-6 col-lg-3 footer-menu">
				<h4>Footer menu</h4>
				<?php wp_nav_menu(array('menu' => 'faq','container' => false,'menu_class' => 'footernav')); ?>
			</div>
			<div class="col-md-6 col-lg-3 footer-menu">
				<h4>Footer menu</h4>
				<?php wp_nav_menu(array('menu' => 'about','container' => false,'menu_class' => 'footernav')); ?>
			</div>
		</div>
	</div>
</div>
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col">
				&copy; <?php echo date("Y");?> <?php echo $adres['bedrijfsnaam']; ?> • 
				<?php if ($av = $adres['av']) echo '<a href="'.$adres['av'].'" target="_blank">Algemene voorwaarden</a> • ' ?>
				<a href="<?php echo apply_filters( 'wpml_permalink', get_site_url().'/privacy/' ); ?>">Privacy</a> • <a href="<?php echo apply_filters( 'wpml_permalink', get_site_url().'/cookies/' ); ?>">Cookies</a> • <a href="/sitemap/">Sitemap</a> • Door <a href="https://www.vizien.nl" target="_blank">Vizien.nl</a>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.cookie-container{position: fixed;bottom: 20px;z-index: 999999999;width: 100%;margin: 0 auto;left: 0;right: 0;font-family: 'Poppins', sans-serif;}.cookies{background-color: #FFF;color: #000;overflow: hidden;border-radius: 5px 5px 0 0;border-bottom: 5px solid #e74011;padding: 24px;}.cookies h4{margin: 0 10px 0 0;font-size:22px;font-weight: 600;line-height:33px;}.cookies img{height: 30px;width: 30px;object-fit:contain;}.cookies p{font-size:14px;line-height: 24px;color: #000;margin: 15px 0;font-weight: 400;}.cookies a.cookie-decline{margin-right: 20px;text-decoration: underline;color: #000;font-size: 14px;}.cookies a.cookie-accept{padding:12px 30px;background-color:#e74011;color:#fff;border-radius:5px;text-decoration:none;display:inline-block;font-size: 14px;font-weight: 500;}.cookies a:hover{opacity: 0.85;}@media(min-width: 768px){.cookie-container{bottom: 30px;}}@media(min-width: 992px){.cookie-container{bottom: 40px;left:40px;margin:unset;}.cookies{padding:30px 40px;}.cookies h4{font-size: 29px;}.cookies img{width: 40px;height:40px;}.cookies a.cookie-decline, .cookies a.cookie-accept{font-size: 16px;}.cookies p{margin: 20px 0 0 0;font-size: 16px;line-height: 28px;}
	}
</style>

<div class="container cookie-container">
	<div class="row">
		<div class="col-12 col-lg-8">
			<div class="cookies shadow position-relative" id="cookies" style="display:none">
				<div class="cookie-header d-flex justify-content-start align-items-center justify-content-lg-between">
					<div class="d-flex align-items-center flex-row">
						<h4>Cookies!</h4><img src="<?php bloginfo('template_directory'); ?>/images/cookies.png" />
					</div>
					<div class="d-none d-lg-inline-flex align-items-lg-center">
						<a href="#" class="cookie-decline">Nee, sluiten</a><a class="cookie-accept" href="#">Ok!</a>
					</div>
				</div>
				<div class="cookie-content text-start">
					<p>Lorem ipsum commodo cupidatat commodo aute duis exercitation cillum fugiat minim labore fugiat veniam. Mollit esse fugiat proident fugiat veniam est in magna.</p>
				</div>
				<div class="cookie-buttons d-flex flex-row align-items-center d-lg-none">
					<a href="#" class="cookie-decline transition">Nee, sluiten</a><a class="cookie-accept transition" href="/cookies/">Ok!</a>
				</div>
			</div>
		</div>
	</div>
</div>	

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/modernizr-custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lib.js"></script>
<!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/swiper-bundle.core.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox.umd.js"></script> -->
<!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/imagesloaded.pkgd.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/masonry.pkgd.min.js"></script> -->
</body>
</html>