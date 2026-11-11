<?php
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }
function setup() {
	load_theme_textdomain( 'webzine-material3', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'custom-header', array( 'width' => 1400, 'height' => 600, 'flex-width' => true, 'flex-height' => true ) );
	// The design color role supplies the default. Core emits a background-color
	// declaration only when an editor deliberately selects a native override.
	$background = array( 'default-color' => '' );
	if ( ! empty( design()['background_asset'] ) ) { $background['default-image'] = get_theme_file_uri( '/' . design()['background_asset'] ); $background['default-size'] = 'cover'; $background['default-attachment'] = 'fixed'; }
	add_theme_support( 'custom-background', $background );
	add_image_size( 'wz-cover', 1280, 760, true );
	add_image_size( 'wz-thumb', 420, 280, true );
	add_editor_style( 'assets/editor.css' );
	register_nav_menus( array(
		'primary' => __( '顶部主导航', 'webzine-material3' ), 'rail' => __( '左侧按钮栏', 'webzine-material3' ),
		'bottom' => __( '底部按钮栏', 'webzine-material3' ), 'drawer' => __( '抽屉目录', 'webzine-material3' ),
		'utility' => __( '辅助链接', 'webzine-material3' ), 'footer' => __( '内容页脚', 'webzine-material3' ),
	) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

function assets() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'webzine-material3', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'webzine-material3-layout', get_theme_file_uri( '/assets/layout.css' ), array( 'webzine-material3' ), $version . '.' . filemtime( get_theme_file_path( '/assets/layout.css' ) ) );
	wp_enqueue_style( 'webzine-material3-design', get_theme_file_uri( '/assets/design.css' ), array( 'webzine-material3-layout' ), $version . '.' . filemtime( get_theme_file_path( '/assets/design.css' ) ) );
	wp_enqueue_script( 'webzine-material3', get_theme_file_uri( '/assets/app.js' ), array(), $version . '.' . filemtime( get_theme_file_path( '/assets/app.js' ) ), true );
	wp_localize_script( 'webzine-material3', 'Webzine', array(
		'namespace' => 'webzine-material3:' . md5( home_url( '/' ) ),
		'saved' => __( '已收藏到本机', 'webzine-material3' ), 'removed' => __( '已取消收藏', 'webzine-material3' ),
		'empty' => __( '本机收藏暂时为空。浏览文章时点击收藏按钮即可添加。', 'webzine-material3' ),
		'unavailable' => __( '浏览器存储不可用，本次收藏仅保留到关闭页面。', 'webzine-material3' ),
		'copied' => __( '链接已复制', 'webzine-material3' ), 'copy' => __( '请从地址栏复制链接', 'webzine-material3' ),
	) );
	$vars = array(
		'frame' => number( 'frame_width', 1080, 520, 1200 ) . 'px', 'rail' => number( 'rail_width', 52, 44, 76 ) . 'px',
		'bottom' => number( 'bottom_height', 54, 44, 76 ) . 'px', 'reading' => number( 'reading_width', 700, 420, 820 ) . 'px',
		'type-scale' => number( 'type_scale', 100, 90, 140 ) / 100,
		'ink' => color( 'ink', '#22262c' ), 'muted' => color( 'muted', '#626973' ),
		'paper' => color( 'paper', '#ffffff' ), 'surface' => color( 'surface', '#f0f2f3' ),
		'background' => color( 'background', '#edf0f2' ), 'line' => color( 'line', '#d2d6da' ),
		'accent' => color( 'accent', '#324f6e' ), 'on-accent' => color( 'on_accent', '#ffffff' ),
		'rail-bg' => color( 'rail_background', '#202429' ), 'rail-ink' => color( 'rail_ink', '#f5f7fa' ),
		'grid-opacity' => number( 'grid_strength', 5, 0, 15 ) / 100,
		'glass-opacity' => number( 'glass_opacity', 85, 55, 100 ) / 100,
		'bevel' => number( 'bevel', 1, 0, 3 ) . 'px', 'shadow-offset' => number( 'shadow_offset', 4, 0, 8 ) . 'px',
		'radius' => number( 'radius', 24, 0, 32 ) . 'px',
		'blur' => number( 'blur_strength', 18, 0, 32 ) . 'px',
		'border-width' => number( 'border_width', 2, 1, 4 ) . 'px',
		'frame-height' => number( 'frame_height', 900, 480, 1200 ) . 'px',
		'map-ratio' => number( 'map_ratio', 38, 28, 48 ) . '%',
		'list-thumb' => number( 'thumbnail_width', 78, 48, 140 ) . 'px',
		'list-ratio' => array( 'landscape' => '1.25', 'square' => '1', 'portrait' => '.75' )[ option( 'thumbnail_ratio', 'landscape' ) ] ?? '1.25',
		'print-exposure' => number( 'print_exposure', 100, 60, 160 ) / 100,
		'frame-shadow' => number( 'frame_shadow', 16, 0, 40 ) / 100,
		'headline-weight' => number( 'headline_weight', 900, 600, 900 ),
	);
	foreach ( design()['color_vars'] ?? array() as $key => $fallback ) { $vars[ $key ] = color( $key, $fallback ); }
	$scheme = option( 'color_scheme', design()['color_scheme'] ?? 'light' ) === 'dark' ? 'dark' : 'light';
	$css = ':root{color-scheme:' . $scheme . ';'; foreach ( $vars as $name => $value ) { $css .= '--wz-' . $name . ':' . $value . ';'; } $css .= '}';
	$header_color = sanitize_hex_color( '#' . get_header_textcolor() );
	if ( $header_color ) { $css .= '.wz-site-title{color:' . $header_color . ';}'; }
	wp_add_inline_style( 'webzine-material3-design', $css );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets' );
function body_classes( $classes ) {
	$classes[] = 'wz'; $classes[] = 'wz-webzine-material3';
	$classes[] = option( 'density', 'comfortable' ) === 'compact' ? 'wz-compact' : 'wz-comfortable';
	$classes[] = 'wz-font-' . sanitize_html_class( option( 'body_font', 'serif' ) );
	$classes[] = 'wz-view-' . sanitize_html_class( option( 'archive_view', 'list' ) );
	foreach ( array( 'rail', 'bottom', 'images' ) as $key ) { if ( ! option( 'show_' . $key, true ) ) { $classes[] = 'wz-no-' . $key; } }
	if ( option( 'reduce_effects', false ) ) { $classes[] = 'wz-reduced-effects'; }
	if ( is_admin_bar_showing() ) { $classes[] = 'wz-admin-bar'; }
	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\body_classes' );

/** Keep native editing typography aligned with the selected reading settings. */
function editor_reading_css() {
	$font = option( 'body_font', 'serif' ) === 'sans' ? "-apple-system,BlinkMacSystemFont,'Segoe UI','PingFang SC',sans-serif" : "'Iowan Old Style','Songti SC',Georgia,serif";
	$ink = color( 'ink', design()['defaults']['ink'] );
	$paper = color( 'paper', design()['defaults']['paper'] );
	$link = color( 'accent', design()['defaults']['accent'] );
	if ( 'webzine-neobrutal' === get_stylesheet() ) { $link = $ink; }
	return 'body,.editor-styles-wrapper{font-family:' . $font . ';font-size:' . ( 18 * number( 'type_scale', 100, 90, 140 ) / 100 ) . 'px;line-height:1.95;color:' . $ink . ';background-color:' . $paper . ';}.editor-styles-wrapper a,body.mce-content-body a{color:' . $link . ';}.editor-styles-wrapper h2,body.mce-content-body h2{line-height:1.5;}';
}
function block_editor_settings( $settings, $context ) {
	if ( empty( $context->post ) ) { return $settings; }
	$settings['styles'][] = array( 'css' => editor_reading_css() );
	return $settings;
}
add_filter( 'block_editor_settings_all', __NAMESPACE__ . '\\block_editor_settings', 10, 2 );
function classic_editor_settings( $settings, $editor_id ) {
	if ( in_array( $editor_id, array( 'content', 'classic-block' ), true ) ) { $settings['content_style'] = ( $settings['content_style'] ?? '' ) . editor_reading_css(); }
	return $settings;
}
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\\classic_editor_settings', 10, 2 );
