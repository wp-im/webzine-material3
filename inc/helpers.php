<?php
/** Shared source; bundled into each independent theme by tools/build.py. */
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }

function design() {
	static $design;
	if ( null === $design ) { $design = require get_theme_file_path( '/inc/design.php' ); }
	return $design;
}
function option( $key, $fallback = '' ) {
	$defaults = design()['defaults'];
	if ( 'dark' === get_theme_mod( 'wz_color_scheme', 'light' ) && isset( design()['dark_defaults'][ $key ] ) ) {
		$defaults[ $key ] = design()['dark_defaults'][ $key ];
	}
	return get_theme_mod( 'wz_' . $key, $defaults[ $key ] ?? $fallback );
}
function number( $key, $default, $min, $max ) {
	return max( $min, min( $max, (float) option( $key, $default ) ) );
}
function color( $key, $fallback ) { return sanitize_hex_color( option( $key, $fallback ) ) ?: $fallback; }
function posts_url() {
	$id = (int) get_option( 'page_for_posts' );
	return $id ? get_permalink( $id ) : home_url( '/?post_type=post' );
}
function section_heading( $title, $url = '', $label = '' ) {
	echo '<div class="wz-section-heading"><h2>' . esc_html( $title ) . '</h2>';
	if ( $url ) { echo '<a class="wz-more" href="' . esc_url( $url ) . '">' . esc_html( $label ?: __( '全部文章', 'webzine-material3' ) ) . ' <span aria-hidden="true">↗</span></a>'; }
	echo '</div>';
}
function icon( $name ) {
	$icons = array(
		'menu' => 'M4 7h16M4 12h16M4 17h16', 'home' => 'm3 10 9-7 9 7v11H3z M9 21v-8h6v8',
		'book' => 'M3 4h7l2 2 2-2h7v16h-7l-2 2-2-2H3z M12 6v16', 'grid' => 'M3 3h7v7H3z M14 3h7v7h-7z M3 14h7v7H3z M14 14h7v7h-7z',
		'layers' => 'm3 7 9-5 9 5-9 5z m0 5 9 5 9-5 m-18 5 9 5 9-5', 'bookmark' => 'M6 3h12v18l-6-4-6 4z',
		'search' => 'M15.5 15.5 21 21 M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0', 'user' => 'M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0 M4 21a8 8 0 0 1 16 0',
		'folder' => 'M3 5h7l2 3h9v12H3z', 'info' => 'M12 10v7 M12 6v1 M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0',
		'mail' => 'M3 5h18v14H3z m0 0 9 8 9-8', 'list' => 'M8 5h13M8 12h13M8 19h13M3 5h1M3 12h1M3 19h1',
		'settings' => 'M12 2v4m0 12v4M2 12h4m12 0h4M5 5l3 3m8 8 3 3M19 5l-3 3M8 16l-3 3 M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0',
		'close' => 'm5 5 14 14M19 5 5 19', 'share' => 'M12 16V3m-5 5 5-5 5 5M5 13v8h14v-8',
		'arrow' => 'M4 12h16m-6-6 6 6-6 6', 'map' => 'm3 5 6-2 6 2 6-2v16l-6 2-6-2-6 2z M9 3v16M15 5v16',
	);
	$path = $icons[ $name ] ?? $icons['grid'];
	return '<svg class="wz-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' . $path . '"/></svg>';
}
function metadata( $post_id = 0 ) {
	$id = $post_id ?: get_the_ID();
	if ( option( 'show_date', true ) ) { echo '<time datetime="' . esc_attr( get_the_date( DATE_W3C, $id ) ) . '">' . esc_html( get_the_date( 'Y.m.d', $id ) ) . '</time>'; }
	$author = (int) get_post_field( 'post_author', $id ); $name = $author ? get_the_author_meta( 'display_name', $author ) : '';
	if ( option( 'show_author', true ) && $name ) { echo '<a href="' . esc_url( get_author_posts_url( $author ) ) . '">' . esc_html( $name ) . '</a>'; }
}
function save_button( $post_id = 0 ) {
	if ( ! option( 'bookmarks', true ) || post_password_required( $post_id ) ) { return; }
	$id = $post_id ?: get_the_ID();
	printf( '<button class="wz-save wz-icon-button" type="button" data-save="%1$d" data-title="%2$s" data-url="%3$s" aria-pressed="false" aria-label="%4$s">%5$s</button>', (int) $id, esc_attr( get_the_title( $id ) ), esc_url( get_permalink( $id ) ), esc_attr__( '收藏文章到本机', 'webzine-material3' ), icon( 'bookmark' ) );
}
function entry( $post = null, $view = 'list' ) {
	if ( $post ) { $GLOBALS['post'] = $post; setup_postdata( $post ); }
	get_template_part( 'parts/entry', null, array( 'view' => $view ) );
}
function feed( $args = array(), $class = '' ) {
	$args = wp_parse_args( $args, array( 'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false, 'posts_per_page' => 6, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
	$query = new \WP_Query( apply_filters( 'webzine-material3_feed_query', $args ) );
	$view = str_contains( $class, 'wz-feed-index' ) ? 'index' : ( str_contains( $class, 'wz-feed-grid' ) ? 'grid' : 'list' );
	if ( option( 'show_images', true ) && $view !== 'index' ) { update_post_thumbnail_cache( $query ); }
	if ( $query->have_posts() ) {
		echo '<div class="wz-feed ' . esc_attr( $class ) . '">';
		while ( $query->have_posts() ) { $query->the_post(); entry( null, $view ); }
		echo '</div>';
	} else { echo '<p class="wz-empty">' . esc_html__( '这里还没有内容。发布文章后会自动更新。', 'webzine-material3' ) . '</p>'; }
	wp_reset_postdata();
}
function widget_area( $name ) {
	if ( is_active_sidebar( 'wz-' . $name ) ) {
		echo '<div class="wz-widgets wz-widgets-' . esc_attr( $name ) . '">';
		dynamic_sidebar( 'wz-' . $name );
		echo '</div>';
	}
}
function featured() {
	if ( ! option( 'show_cover', true ) ) { return 0; }
	$id = absint( option( 'featured_post', 0 ) );
	if ( $id && ( get_post_status( $id ) !== 'publish' || get_post_type( $id ) !== 'post' || post_password_required( $id ) ) ) { $id = 0; }
	if ( ! $id ) {
		$args = array( 'posts_per_page' => 1, 'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false );
		if ( option( 'featured_category' ) ) { $args['cat'] = absint( option( 'featured_category' ) ); }
		$posts = get_posts( $args );
		$id = $posts ? $posts[0]->ID : 0;
	}
	return $id;
}
function cover( $id, $class = '' ) {
	if ( ! $id || ! option( 'show_cover', true ) ) { return; }
	$p = get_post( $id ); $GLOBALS['post'] = $p; setup_postdata( $p );
	get_template_part( 'parts/cover', null, array( 'class' => $class ) );
	wp_reset_postdata();
}
function topics( $number = 8 ) {
	$terms = get_categories( array( 'hide_empty' => true, 'number' => $number, 'parent' => 0 ) );
	echo '<div class="wz-topics">';
	foreach ( $terms as $i => $term ) {
		echo '<a href="' . esc_url( get_category_link( $term ) ) . '"><span class="wz-index">' . esc_html( sprintf( '%02d', $i + 1 ) ) . '</span><strong>' . esc_html( $term->name ) . '</strong><span class="wz-count">' . (int) $term->count . '</span>' . icon( 'arrow' ) . '</a>';
	}
	echo '</div>';
}

/** Native tables/code remain scrollable by keyboard, including without JavaScript. */
function keyboard_scroll_regions( $content ) {
	$processor = new \WP_HTML_Tag_Processor( $content );
	while ( $processor->next_tag() ) {
		if ( in_array( $processor->get_tag(), array( 'TABLE', 'PRE' ), true ) && null === $processor->get_attribute( 'tabindex' ) ) {
			$processor->set_attribute( 'tabindex', '0' );
		}
	}
	return $processor->get_updated_html();
}
add_filter( 'the_content', __NAMESPACE__ . '\\keyboard_scroll_regions', 20 );
