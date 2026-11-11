<?php
namespace Webzine\Material3;
$mode = option( 'home_mode', 'editorial' );
// An explicit built-in post query is the article index, even when WordPress
// also routes the latest-posts home through front-page.php.
if ( get_query_var( 'post_type' ) === 'post' ) { require get_theme_file_path( '/index.php' ); return; }
if ( $mode === 'blog' && get_option( 'show_on_front' ) === 'posts' ) { require get_theme_file_path( '/index.php' ); return; }
get_header();
if ( $mode === 'blog' ) { echo '<header class="wz-page-heading"><h1>' . esc_html( option( 'home_title' ) ?: get_bloginfo( 'name' ) ) . '</h1></header>'; }
if ( get_option( 'show_on_front' ) === 'page' && ( $mode === 'page' || option( 'show_static_body', true ) ) ) {
	while ( have_posts() ) { the_post(); if ( $mode === 'page' ) { echo '<header class="wz-page-heading"><h1>'; the_title(); echo '</h1></header>'; } if ( trim( get_the_content() ) ) { echo '<div class="wz-static-intro entry-content wz-prose">'; the_content(); wp_link_pages(); echo '</div>'; } }
}
if ( $mode === 'blog' ) {
	section_heading( __( '最新文章', 'webzine-material3' ), posts_url() );
	feed( array( 'posts_per_page' => (int) get_option( 'posts_per_page', 12 ) ), 'wz-feed-' . option( 'archive_view', 'list' ) );
} elseif ( $mode !== 'page' || get_option( 'show_on_front' ) !== 'page' ) {
	widget_area( 'home-top' ); get_template_part( 'parts/home' ); widget_area( 'home-bottom' );
}
get_footer();
