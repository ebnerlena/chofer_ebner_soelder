<?php 
 $context          = Timber::context();
 $context['posts'] = new Timber\PostQuery();
 $context['post'] = new Timber\Post();


 $templates        = array( 'index.twig' );
Timber::render( $templates, $context );

?>
