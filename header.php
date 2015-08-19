<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_DIR; ?>/vendor.css" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_DIR; ?>/main.css" media="all" />
	<script type="text/javascript">
		var console = window.console || { log: function() {} }; //browser console fix
	</script>
	<script src="<?php echo BOWER_DIR; ?>/modernizr/modernizr.js"></script>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <section class="site-container animsition">
    <header class="site-header">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">

						<div class="container">
							<div class="row">
								<div class="col-xs-6 nav-branding">
                	<h1 class="navbar-brand">
                  	<a href="/" title="<?php echo bloginfo("title"); ?>">
                    	<img src="<?php echo get_template_directory_uri(); ?>/img/brand-logo.png" class="img-responsive" alt="<?php echo bloginfo("title"); ?>" />
                		</a>
	                </h1>
                </div>

								<div class="col-xs-6 nav-social-container">
									<?php include(locate_template('partials/nav-social.php')); ?>
								</div>

                <div class="col-xs-6 visible-xs nav-actions">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site_header_navbar">
                  	<span class="sr-only">Toggle navigation</span>
                  	<span class="icon-bar"></span>
                  	<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
              </div>

            </div>

						<div class="site-navbar-container">
							<div class="container">
								<div class="row">
									<?php
										wp_nav_menu( array(
											'theme_location'    => 'main',
											'depth'             => 1,
											'container'         => 'div',
											'container_class'   => 'collapse navbar-collapse',
											'container_id'      => 'site_header_navbar',
											'menu_class'        => 'site-navbar'
										) );
									?>
								</div>
							</div>
						</div>

				</div>
      </nav>
		</header>
    <div class="body-content">
