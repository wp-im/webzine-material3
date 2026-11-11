<?php
namespace Webzine\Material3;
get_header();
widget_area( 'archive-top' );
?>
<header class="wz-page-heading"><span class="wz-eyebrow"><?php esc_html_e( 'READING INDEX', 'webzine-material3' ); ?></span><h1><?php
if ( is_search() ) { printf( esc_html__( '搜索：%s', 'webzine-material3' ), esc_html( get_search_query( false ) ) ); }
elseif ( is_archive() ) { the_archive_title(); }
else { esc_html_e( '文章与档案', 'webzine-material3' ); }
?></h1><?php if ( is_archive() ) { the_archive_description( '<div class="wz-archive-description">', '</div>' ); } ?></header>
<?php if ( is_search() ) { get_search_form(); } ?>
<?php do_action( 'webzine-material3_before_archive' ); ?>
<div class="wz-archive wz-feed wz-feed-<?php echo esc_attr( option( 'archive_view', 'list' ) ); ?>">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); entry( null, option( 'archive_view', 'list' ) ); endwhile;
else : ?><div class="wz-empty"><h2><?php esc_html_e( '没有找到匹配内容', 'webzine-material3' ); ?></h2><p><?php esc_html_e( '可以更换关键词，或从目录继续浏览。', 'webzine-material3' ); ?></p><?php if ( ! is_search() ) { get_search_form(); } ?></div><?php endif; ?>
</div>
<?php the_posts_pagination( array( 'prev_text' => __( '上一页', 'webzine-material3' ), 'next_text' => __( '下一页', 'webzine-material3' ) ) ); ?>
<?php do_action( 'webzine-material3_after_archive' ); widget_area( 'archive-bottom' ); get_footer(); ?>
