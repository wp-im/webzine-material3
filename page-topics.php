<?php
/** Template Name: 专题目录 */
namespace Webzine\Material3;
get_header(); while ( have_posts() ) { the_post(); echo '<header class="wz-page-heading"><h1>'; the_title(); echo '</h1></header><div class="entry-content wz-prose">'; the_content(); echo '</div>'; }
topics( 30 ); widget_area( 'page-bottom' ); get_footer();
