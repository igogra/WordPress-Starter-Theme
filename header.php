<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="<?php echo esc_url(home_url('/')); ?>favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="img/icons/favicon-57.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/icons/favicon-57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icons/favicon-72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icons/favicon-114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/icons/favicon-120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/icons/favicon-144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/favicon-152.png">
    <meta name="application-name" content="<?php bloginfo('name'); ?>">
    <meta name="msapplication-TileImage" content="img/icons/favicon-144.png">
    <meta name="msapplication-TileColor" content="#fff">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class'=> 'nav navbar-nav')); ?>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input class="form-control" type="search" value="<?php echo get_search_query(); ?>" name="s" />
                    </div>
                    <button type="submit" class="btn btn-success"><span>Buscar</span></button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
