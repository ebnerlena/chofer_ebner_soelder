<?php

$context = Timber::context();

//stored in wp-config
$context['API_KEY']= $API_KEY;
$context['post'] = new Timber\Post();

Timber::render( 'page-gigs.twig', $context );

?>