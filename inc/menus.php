<?php
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }
function menu_icon_title( $title, $item, $args, $depth ) {
	if ( ! isset( $args->theme_location ) || ! in_array( $args->theme_location, array( 'rail', 'bottom' ), true ) ) { return $title; }
	$name = 'grid';
	foreach ( (array) $item->classes as $class ) {
		if ( preg_match( '/^wz-icon-(home|book|grid|layers|bookmark|search|user|folder|info|mail|list|settings|map)$/', $class, $m ) ) { $name = $m[1]; break; }
	}
	return icon( $name ) . '<span class="wz-nav-label' . ( option( 'show_labels', true ) ? '' : ' screen-reader-text' ) . '">' . $title . '</span>';
}
add_filter( 'nav_menu_item_title', __NAMESPACE__ . '\\menu_icon_title', 10, 4 );
function menu_items( $items ) {
	if ( option( 'bookmarks', true ) ) { return $items; }
	return array_values( array_filter( $items, static function ( $item ) {
		return ! in_array( $item->url, array( '#wz-saved', home_url( '/#wz-saved' ) ), true );
	} ) );
}
add_filter( 'wp_nav_menu_objects', __NAMESPACE__ . '\\menu_items' );
function menu( $location ) {
	if ( has_nav_menu( $location ) ) {
		wp_nav_menu( array( 'theme_location' => $location, 'container' => false, 'menu_class' => 'wz-menu wz-menu-' . $location, 'depth' => $location === 'drawer' ? 3 : 1, 'fallback_cb' => false ) );
		return;
	}
	if ( ! in_array( $location, array( 'rail', 'bottom' ), true ) ) { return; }
	$items = array( array( 'home', __( '首页', 'webzine-material3' ), home_url( '/' ) ), array( 'book', __( '文章', 'webzine-material3' ), posts_url() ), array( 'search', __( '搜索', 'webzine-material3' ), home_url( '/?s=' ) ) );
	if ( option( 'bookmarks', true ) ) { $items[] = array( 'bookmark', __( '收藏', 'webzine-material3' ), '#wz-saved' ); }
	echo '<ul class="wz-menu wz-menu-' . esc_attr( $location ) . '">';
	foreach ( $items as $item ) { echo '<li><a href="' . esc_url( $item[2] ) . '">' . icon( $item[0] ) . '<span class="wz-nav-label' . ( option( 'show_labels', true ) ? '' : ' screen-reader-text' ) . '">' . esc_html( $item[1] ) . '</span></a></li>'; }
	echo '</ul>';
}
