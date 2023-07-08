<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
	<title><?php wp_title(' | ', true, 'right'); ?></title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
		
	<link rel="stylesheet" rel="preload" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" as="style">
	<link rel="stylesheet" rel="preload" href="<?php bloginfo('template_directory'); ?>/css/all.min.css" as="style">

	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/swiper-bundle.core.min.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/fancybox.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.min.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/owl.theme.default.min.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/animate.css" /> -->

	<link rel="stylesheet" rel="preload" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" as="style">

	<?php wp_head(); ?>

	<!-- Structured data -->
	<?php $adres = get_field('bedrijfsgegevens','option'); ?>
	<script type="application/ld+json">
		{
		"@context": "https://schema.org",
		"@type": "LocalBusiness",
		"name": "<?php echo $adres['bedrijfsnaam']; ?>",
		"image": "<?php echo get_stylesheet_directory_uri();?>/images/logo.svg",
		"openingHours": [
			"Mo <?php echo str_replace(' ','',$adres['maandag']);?>", 
			"Tu <?php echo str_replace(' ','',$adres['dinsdag']);?>",
			"We <?php echo str_replace(' ','',$adres['woensdag']);?>",
			"Th <?php echo str_replace(' ','',$adres['donderdag']);?>",
			"Fr <?php echo str_replace(' ','',$adres['vrijdag']);?>",
			"Sa <?php echo str_replace(' ','',$adres['zaterdag']);?>",
			"Su <?php echo str_replace(' ','',$adres['zondag']);?>"
		],
		"telephone": "<?php echo str_replace(" ","",$adres['telefoon']); ?>",
		"url": "<?php echo get_site_url(); ?>",
		"email": "<?php echo $adres['email']; ?>",
		"priceRange": "€ - €€",
		"address":
		{
			"@type": "PostalAddress",
			"streetAddress": "<?php echo $adres['straat'].' '.$adres['huisnummer']; ?>",
			"postalCode": "<?php echo $adres['postcode']; ?>",
			"addressLocality": "<?php echo $adres['plaats']; ?>",
			"addressCountry": "NL"
		},
		"aggregateRating": {
			"@type": "AggregateRating",
			"ratingValue": "<?php echo $score["score"]; ?>",
			"bestRating": "10",
			"ratingCount": "<?php echo $score["aantal"]; ?>"
		}
	}
	</script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-00000000-00"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-00000000-00');
	</script> -->
	
</head>

<body <?php body_class(); ?>>

<div class="sticky-top">
	<div class="secnav">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php wp_nav_menu(array('menu' => 'secnav','container' => false,'menu_class' => 'sec-nav')); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="top">
		<div class="container">
			<div class="row">
				<div class="col-lg-2">
					<a href="/" class="logo-wrap">
						<img class="logo" width="196" height="60" alt="" src="<?php echo get_stylesheet_directory_uri();?>/images/logo.svg">
					</a>
				</div>
				<div class="col-lg-10 text-end d-lg-flex align-items-center justify-content-end">
					<nav class="navbar navbar-expand-lg">
						<div class="navbar-header d-block d-lg-none">
							<a class="navbar-brand logo-wrap-m" href="/">
								<img class="logo-m" width="150" height="47" alt="" src="<?php echo get_stylesheet_directory_uri();?>/images/logo.svg">
							</a>
							<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nav2" aria-controls="nav2" aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon-bar top-bar"></span>
								<span class="icon-bar middle-bar"></span>
								<span class="icon-bar bottom-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="nav2">
							<?php wp_nav_menu(array('menu' => 'hoofdmenu','container' => false,'menu_class' => 'nav navbar-nav')); ?>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>