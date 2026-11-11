<?php
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text wz-skip" href="#wz-main"><?php esc_html_e( '跳到正文', 'webzine-material3' ); ?></a>
<div class="wz-environment">
<?php if ( option( 'brand_signature' ) ) : ?><div class="wz-signature" aria-hidden="true"><?php echo esc_html( option( 'brand_signature' ) ); ?></div><?php endif; ?>
<div class="wz-app">
<aside class="wz-rail" aria-label="<?php esc_attr_e( '左侧按钮栏', 'webzine-material3' ); ?>">
 <button class="wz-brand-button" type="button" data-open="wz-drawer" aria-haspopup="dialog" aria-label="<?php esc_attr_e( '打开导航目录', 'webzine-material3' ); ?>"><?php echo icon( 'menu' ); ?></button>
 <nav aria-label="<?php esc_attr_e( '主要入口', 'webzine-material3' ); ?>"><?php menu( 'rail' ); ?></nav>
 <a class="wz-rail-end" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( '返回首页', 'webzine-material3' ); ?>"><span aria-hidden="true">W.</span></a>
</aside>
<div class="wz-workspace">
<?php get_template_part( 'parts/topbar' ); ?>
<div class="wz-stage" id="wz-scroll"><main class="wz-main" id="wz-main" tabindex="-1">
