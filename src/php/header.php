<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="This is just a test wp theme site never mind">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Web Starter Kit">
    
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Web Starter Kit">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#2F3BA2">

    <!-- Color the status bar on mobile devices -->
    <meta name="theme-color" content="#303030">

<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >
<?php wp_body_open(); ?>
  <header>
  
  <h1>Chris Hofer</h1>
  <nav id="header-top">
  <?php wp_nav_menu( array ('theme_location' => 'main-menu')); ?>
  </nav>
    <!--<div id="burger-nav">
        <button class="hamburger hamburger--slider" id="burger-button" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>  
    </div>
    <div style="display: none;" id="burger-nav-items">
      <?php //wp_nav_menu( array ('theme_location' => 'main-menu')); ?>
    </div>

    <div id="normal-nav">
        <?php //wp_nav_menu( array ('theme_location' => 'main-menu')); ?>
    </div>
  </nav>

  <?php //while(have_posts()): the_post(); ?>
  <section id="hero" style="background-image: url('<?php //echo get_the_post_thumbnail_url( null, 'full' ); ?>')">

        <div id="hero-right">
          <h1>
            <span><?php //the_field('content'); ?></span>
          </h1>
          <a href="https://wp.vm-aqua.soelder.net/kontakt/"> Angebot einholen</a>
        </div>
      </section> -->
<?php // endwhile; ?>
</header>
<main>