<?php namespace Webzine\Material3; if ( post_password_required() ) { return; } ?>
<section class="wz-comments" id="comments"><h2><?php printf( esc_html__( '讨论与回应（%s）', 'webzine-material3' ), esc_html( get_comments_number() ) ); ?></h2>
<?php if ( have_comments() ) : ?><ol class="comment-list"><?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 0 ) ); ?></ol><?php the_comments_navigation(); endif; ?>
<?php comment_form(); ?></section>
