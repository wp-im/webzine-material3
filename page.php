<?php namespace Webzine\Material3; get_header(); while ( have_posts() ) : the_post(); ?>
<article <?php post_class( 'wz-document wz-page' ); ?>><header class="wz-document-heading"><span class="wz-eyebrow"><?php esc_html_e( 'INFORMATION / 站点资料', 'webzine-material3' ); ?></span><h1><?php the_title(); ?></h1></header><div class="entry-content wz-prose"><?php the_content(); ?></div><?php wp_link_pages(); ?></article>
<?php widget_area( 'page-bottom' ); if ( comments_open() || get_comments_number() ) { comments_template(); } endwhile; get_footer(); ?>
