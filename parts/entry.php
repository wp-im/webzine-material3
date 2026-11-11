<?php namespace Webzine\Material3; ?>
<article <?php post_class( 'wz-entry' ); ?>>
 <?php if ( option( 'show_images', true ) && ( $args['view'] ?? 'list' ) !== 'index' && has_post_thumbnail() && ! post_password_required() ) : ?><a class="wz-entry-image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'wz-thumb', array( 'alt' => '', 'loading' => 'lazy' ) ); ?></a><?php endif; ?>
 <div class="wz-entry-copy"><div class="wz-entry-category"><?php $cat = get_the_category(); if ( $cat ) { echo '<a href="' . esc_url( get_category_link( $cat[0] ) ) . '">' . esc_html( $cat[0]->name ) . '</a>'; } ?></div><h2 class="wz-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
 <?php if ( ( $args['view'] ?? 'list' ) !== 'index' && number( 'excerpt_length', 36, 0, 100 ) && ! post_password_required() ) : ?><p class="wz-entry-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), (int) number( 'excerpt_length', 36, 0, 100 ), '…' ) ); ?></p><?php endif; ?>
 <div class="wz-meta"><?php metadata(); ?></div></div><?php save_button(); ?>
</article>
