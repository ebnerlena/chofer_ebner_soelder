<?php 
 $context          = Timber::context();
 $context['posts'] = new Timber\PostQuery();
 $context['post'] = new Timber\Post();
// $context['foo']   = 'bar';


 $templates        = array( 'index.twig' );
// if ( is_home() ) {
// 	array_unshift( $templates, 'front-page.twig', 'home.twig' );
// }
Timber::render( $templates, $context );
