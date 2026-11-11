<?php namespace Webzine\Material3; get_header(); while ( have_posts() ) : the_post(); ?>
<article <?php post_class( 'wz-document' ); ?>><header class="wz-document-heading"><h1><?php the_title(); ?></h1></header>
<?php if ( ! post_password_required() ) : ?>
<div class="wz-prose entry-content"><?php if ( wp_attachment_is_image() ) : ?><figure><?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?><figcaption><?php echo esc_html( wp_get_attachment_caption( get_the_ID() ) ); ?></figcaption></figure><?php endif; ?><?php the_content(); ?><p><a href="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ); ?>"><?php esc_html_e( '打开原始媒体文件', 'webzine-material3' ); ?></a></p></div>
<?php else : the_content(); endif; ?></article>
<?php endwhile; get_footer(); ?>
