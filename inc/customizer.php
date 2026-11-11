<?php
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }
function schema() {
	$items = array(
		'frame_width' => array( 'layout', 'number', __( '桌面框架宽度（px）', 'webzine-material3' ), 1080, 520, 1200 ),
		'rail_width' => array( 'layout', 'number', __( '左栏宽度（px）', 'webzine-material3' ), 52, 44, 76 ),
		'bottom_height' => array( 'layout', 'number', __( '底栏高度（px）', 'webzine-material3' ), 54, 44, 76 ),
		'reading_width' => array( 'reading', 'number', __( '正文最大宽度（px）', 'webzine-material3' ), 700, 420, 820 ),
		'type_scale' => array( 'reading', 'number', __( '正文字号比例（%）', 'webzine-material3' ), 100, 90, 140 ),
		'latest_count' => array( 'home', 'number', __( '首页最新文章数量', 'webzine-material3' ), 8, 4, 20 ),
		'excerpt_length' => array( 'lists', 'number', __( '摘要长度', 'webzine-material3' ), 36, 0, 100 ),
		'density' => array( 'layout', 'select', __( '信息密度', 'webzine-material3' ), 'comfortable', array( 'comfortable' => __( '舒适', 'webzine-material3' ), 'compact' => __( '紧凑', 'webzine-material3' ) ) ),
		'home_mode' => array( 'home', 'select', __( '首页显示方式', 'webzine-material3' ), 'editorial', array( 'editorial' => __( '编辑首页', 'webzine-material3' ), 'blog' => __( '文章列表', 'webzine-material3' ), 'page' => __( '静态页面正文', 'webzine-material3' ) ) ),
		'archive_view' => array( 'lists', 'select', __( '归档显示方式', 'webzine-material3' ), 'list', array( 'list' => __( '紧凑列表', 'webzine-material3' ), 'grid' => __( '图文网格', 'webzine-material3' ), 'index' => __( '文字索引', 'webzine-material3' ) ) ),
		'body_font' => array( 'reading', 'select', __( '正文字体', 'webzine-material3' ), 'serif', array( 'serif' => __( '系统衬线', 'webzine-material3' ), 'sans' => __( '系统无衬线', 'webzine-material3' ) ) ),
		'home_kicker' => array( 'home', 'text', __( '首页眉题', 'webzine-material3' ), 'AN INDEPENDENT EDITORIAL' ),
		'home_title' => array( 'home', 'text', __( '首页标题（留空用站点名称）', 'webzine-material3' ), '' ),
		'home_description' => array( 'home', 'textarea', __( '首页说明', 'webzine-material3' ), '' ),
		'footer_note' => array( 'footer', 'textarea', __( '内容页脚说明', 'webzine-material3' ), '' ),
		'brand_signature' => array( 'style', 'text', __( '外围品牌文字', 'webzine-material3' ), '' ),
	);
	$checks = array(
		'show_rail' => array( 'navigation', __( '显示左侧按钮栏', 'webzine-material3' ), true ),
		'show_bottom' => array( 'navigation', __( '显示底部按钮栏', 'webzine-material3' ), true ),
		'show_labels' => array( 'navigation', __( '按钮栏显示文字标签', 'webzine-material3' ), true ),
		'show_cover' => array( 'home', __( '显示精选封面', 'webzine-material3' ), true ),
		'show_topics' => array( 'home', __( '显示专题目录', 'webzine-material3' ), true ),
		'show_static_body' => array( 'home', __( '同时显示静态首页正文', 'webzine-material3' ), true ),
		'show_images' => array( 'lists', __( '列表显示缩略图', 'webzine-material3' ), true ),
		'show_author' => array( 'reading', __( '显示作者', 'webzine-material3' ), true ),
		'show_date' => array( 'reading', __( '显示日期', 'webzine-material3' ), true ),
		'show_toc' => array( 'reading', __( '长文显示目录', 'webzine-material3' ), true ),
		'show_progress' => array( 'reading', __( '显示阅读进度', 'webzine-material3' ), true ),
		'show_related' => array( 'reading', __( '显示相关文章', 'webzine-material3' ), true ),
		'bookmarks' => array( 'reading', __( '启用浏览器本机收藏', 'webzine-material3' ), true ),
		'reduce_effects' => array( 'style', __( '减少装饰、透明及动效', 'webzine-material3' ), false ),
	);
	foreach ( $checks as $key => $v ) { $items[ $key ] = array( $v[0], 'checkbox', $v[1], $v[2] ); }
	$colors = array(
		'ink' => array( __( '正文文字', 'webzine-material3' ), '#22262c' ), 'muted' => array( __( '辅助文字', 'webzine-material3' ), '#626973' ),
		'paper' => array( __( '阅读画布', 'webzine-material3' ), '#ffffff' ), 'surface' => array( __( '次级表面', 'webzine-material3' ), '#f0f2f3' ),
		'background' => array( __( '外围背景', 'webzine-material3' ), '#edf0f2' ), 'line' => array( __( '边线', 'webzine-material3' ), '#d2d6da' ),
		'accent' => array( __( '强调色', 'webzine-material3' ), '#324f6e' ), 'on_accent' => array( __( '强调色上的文字', 'webzine-material3' ), '#ffffff' ),
		'rail_background' => array( __( '左栏背景', 'webzine-material3' ), '#202429' ), 'rail_ink' => array( __( '左栏文字', 'webzine-material3' ), '#f5f7fa' ),
	);
	foreach ( $colors as $key => $v ) { $items[ $key ] = array( 'colors', 'color', $v[0], $v[1] ); }
	foreach ( design()['controls'] ?? array() as $key => $control ) { $items[ $key ] = $control; }
	if ( ! empty( design()['dark_defaults'] ) ) {
		$items['color_scheme'] = array( 'colors', 'select', __( '配色预设（切换会应用整套颜色）', 'webzine-material3' ), 'light', array( 'light' => __( '浅色', 'webzine-material3' ), 'dark' => __( '深色', 'webzine-material3' ) ) );
	}
	return $items;
}
function sanitize_number( $value, $setting ) {
	$key = substr( $setting->id, 3 ); $schema = schema(); $v = $schema[ $key ] ?? array();
	if ( ! is_numeric( $value ) ) { return design()['defaults'][ $key ] ?? ( $v[3] ?? 0 ); }
	return max( $v[4] ?? 0, min( $v[5] ?? 1000, (float) $value ) );
}
function sanitize_choice( $value, $setting ) {
	$key = substr( $setting->id, 3 ); $schema = schema(); $v = $schema[ $key ] ?? array();
	return is_scalar( $value ) && array_key_exists( $value, $v[4] ?? array() ) ? $value : ( $v[3] ?? '' );
}
function sanitize_checkbox( $value ) { return (bool) $value; }
function sanitize_post( $value ) {
	$id = absint( $value ); return $id && get_post_status( $id ) === 'publish' && get_post_type( $id ) === 'post' ? $id : 0;
}
function sanitize_category( $value ) { $id = absint( $value ); return $id && term_exists( $id, 'category' ) ? $id : 0; }
function customize( $manager ) {
	$manager->add_panel( 'wz_design', array( 'title' => design()['name'] . ' · ' . __( '设计与布局', 'webzine-material3' ), 'priority' => 30 ) );
	$sections = array( 'layout' => __( '框架与密度', 'webzine-material3' ), 'navigation' => __( '导航栏', 'webzine-material3' ), 'colors' => __( '颜色角色', 'webzine-material3' ), 'home' => __( '编辑首页', 'webzine-material3' ), 'lists' => __( '列表与归档', 'webzine-material3' ), 'reading' => __( '文章与阅读', 'webzine-material3' ), 'style' => __( '风格细节', 'webzine-material3' ), 'footer' => __( '页脚信息', 'webzine-material3' ) );
	foreach ( $sections as $id => $title ) { $manager->add_section( 'wz_' . $id, array( 'title' => $title, 'panel' => 'wz_design' ) ); }
	foreach ( schema() as $key => $v ) {
		$callback = 'sanitize_text_field';
		if ( $v[1] === 'number' ) { $callback = __NAMESPACE__ . '\\sanitize_number'; }
		if ( $v[1] === 'select' ) { $callback = __NAMESPACE__ . '\\sanitize_choice'; }
		if ( $v[1] === 'checkbox' ) { $callback = __NAMESPACE__ . '\\sanitize_checkbox'; }
		if ( $v[1] === 'color' ) { $callback = 'sanitize_hex_color'; }
		if ( $v[1] === 'textarea' ) { $callback = 'sanitize_textarea_field'; }
		$default = design()['defaults'][ $key ] ?? $v[3];
		if ( 'dark' === get_theme_mod( 'wz_color_scheme', 'light' ) && isset( design()['dark_defaults'][ $key ] ) ) { $default = design()['dark_defaults'][ $key ]; }
		$manager->add_setting( 'wz_' . $key, array( 'default' => $default, 'sanitize_callback' => $callback, 'transport' => 'refresh' ) );
		$args = array( 'label' => $v[2], 'section' => 'wz_' . $v[0], 'type' => $v[1] );
		if ( $v[1] === 'number' ) { $args['input_attrs'] = array( 'min' => $v[4], 'max' => $v[5], 'step' => 1 ); }
		if ( $v[1] === 'select' ) { $args['choices'] = $v[4]; }
		if ( $v[1] === 'color' ) { $manager->add_control( new \WP_Customize_Color_Control( $manager, 'wz_' . $key, $args ) ); }
		else { $manager->add_control( 'wz_' . $key, $args ); }
	}
	$choices = array( 0 => __( '自动：最新公开文章', 'webzine-material3' ) );
	foreach ( get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false, 'numberposts' => -1 ) ) as $post ) { $choices[ $post->ID ] = get_the_title( $post ); }
	$manager->add_setting( 'wz_featured_post', array( 'default' => 0, 'sanitize_callback' => __NAMESPACE__ . '\\sanitize_post' ) );
	$manager->add_control( 'wz_featured_post', array( 'label' => __( '精选文章', 'webzine-material3' ), 'section' => 'wz_home', 'type' => 'select', 'choices' => $choices ) );
	$cats = array( 0 => __( '所有分类', 'webzine-material3' ) );
	foreach ( get_categories( array( 'hide_empty' => false ) ) as $cat ) { $cats[ $cat->term_id ] = $cat->name; }
	$manager->add_setting( 'wz_featured_category', array( 'default' => 0, 'sanitize_callback' => __NAMESPACE__ . '\\sanitize_category' ) );
	$manager->add_control( 'wz_featured_category', array( 'label' => __( '优先分类', 'webzine-material3' ), 'section' => 'wz_home', 'type' => 'select', 'choices' => $cats ) );
}
add_action( 'customize_register', __NAMESPACE__ . '\\customize' );

function customize_palette_assets() {
	if ( empty( design()['dark_defaults'] ) ) { return; }
	$keys = array( 'ink', 'muted', 'paper', 'surface', 'background', 'line', 'accent', 'on_accent', 'rail_background', 'rail_ink' );
	$keys = array_merge( $keys, array_keys( design()['color_vars'] ?? array() ) ); $light = array(); $dark = array();
	foreach ( $keys as $key ) { $light[ $key ] = design()['defaults'][ $key ] ?? design()['color_vars'][ $key ]; $dark[ $key ] = design()['dark_defaults'][ $key ] ?? $light[ $key ]; }
	wp_enqueue_script( 'webzine-material3-customize', get_theme_file_uri( '/assets/customize.js' ), array( 'customize-controls' ), wp_get_theme()->get( 'Version' ), true );
	wp_localize_script( 'webzine-material3-customize', 'WebzineCustomize', array( 'palettes' => array( 'light' => $light, 'dark' => $dark ) ) );
}
add_action( 'customize_controls_enqueue_scripts', __NAMESPACE__ . '\\customize_palette_assets' );
