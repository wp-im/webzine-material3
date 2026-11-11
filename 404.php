<?php namespace Webzine\Material3; get_header(); ?>
<div class="wz-empty wz-not-found"><span class="wz-eyebrow">404 / NOT FOUND</span><h1><?php esc_html_e( '这一页暂时没有找到', 'webzine-material3' ); ?></h1><p><?php esc_html_e( '地址可能已更改，试试搜索或回到文章目录。', 'webzine-material3' ); ?></p><?php get_search_form(); ?><a class="wz-button" href="<?php echo esc_url( posts_url() ); ?>"><?php esc_html_e( '浏览全部文章', 'webzine-material3' ); ?></a></div>
<?php get_footer(); ?>
