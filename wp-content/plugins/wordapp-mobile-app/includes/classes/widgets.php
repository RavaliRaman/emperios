<?php

class WordAppClass_widgets  {

	/* Registering the Widgets */
	public function __construct() {

	}
	/* Registering the Widgets */
	function WordApp_register_widget(){

		register_sidebar( array(
				'name' => 'Mobile Header',
				'id' => 'wordapp-mobile-sidebar-header',
				'description' => 'Mobile app and site  header below slideshow above content',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="wordappTitleHeader widget-title">',
				'after_title' => '</h3>',
			) );
		register_sidebar( array(
				'name' => 'Mobile Sidebar Right',
				'id' => 'wordapp-mobile-sidebar-right',
				'description' => 'Mobile app and site side bar',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="wordappTitle widget-title">',
				'after_title' => '</h3>',
			) );

		register_sidebar( array(
				'name' => 'Mobile Sidebar Left',
				'id' => 'wordapp-mobile-sidebar-left',
				'description' => 'Mobile app and site side bar left below navigation',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="wordappTitleLeft widget-title">',
				'after_title' => '</h3>',
			) );



		register_sidebar( array(
				'name' => 'Mobile Footer',
				'id' => 'wordapp-mobile-sidebar-footer',
				'description' => 'Mobile app and site footer below content',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="wordappTitleFooter widget-title">',
				'after_title' => '</h3>',
			) );

	}
}