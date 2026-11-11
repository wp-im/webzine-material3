<?php namespace Webzine\Material3; ?>
</main>
<footer class="wz-content-footer">
<?php widget_area( 'footer-main' ); ?>
<nav aria-label="<?php esc_attr_e( '页脚链接', 'webzine-material3' ); ?>"><?php menu( 'footer' ); ?></nav>
<?php if ( option( 'footer_note' ) ) : ?><p><?php echo nl2br( esc_html( option( 'footer_note' ) ) ); ?></p><?php endif; ?>
<?php widget_area( 'footer-small' ); ?>
<small>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></small>
</footer>
</div>
<div class="wz-bottom" aria-label="<?php esc_attr_e( '常驻底部按钮栏', 'webzine-material3' ); ?>"><span class="wz-bottom-status" aria-hidden="true"><?php echo esc_html( design()['status'] ); ?></span><nav aria-label="<?php esc_attr_e( '底部导航', 'webzine-material3' ); ?>"><?php menu( 'bottom' ); ?></nav></div>
</div></div></div>
<dialog class="wz-dialog wz-drawer" id="wz-drawer" aria-labelledby="wz-drawer-title">
 <div class="wz-dialog-heading"><h2 id="wz-drawer-title"><?php esc_html_e( '阅读目录', 'webzine-material3' ); ?></h2><button class="wz-icon-button" type="button" data-close aria-label="<?php esc_attr_e( '关闭目录', 'webzine-material3' ); ?>"><?php echo icon( 'close' ); ?></button></div>
 <?php widget_area( 'drawer-top' ); ?><nav aria-label="<?php esc_attr_e( '站点目录', 'webzine-material3' ); ?>"><?php menu( 'drawer' ); ?></nav><?php widget_area( 'drawer-bottom' ); ?>
</dialog>
<dialog class="wz-dialog" id="wz-search" aria-labelledby="wz-search-title"><div class="wz-dialog-heading"><h2 id="wz-search-title"><?php esc_html_e( '搜索站内文章', 'webzine-material3' ); ?></h2><button class="wz-icon-button" type="button" data-close aria-label="<?php esc_attr_e( '关闭搜索', 'webzine-material3' ); ?>"><?php echo icon( 'close' ); ?></button></div><?php get_search_form(); ?></dialog>
<?php if ( option( 'bookmarks', true ) ) : ?><dialog class="wz-dialog" id="wz-saved" aria-labelledby="wz-saved-title"><div class="wz-dialog-heading"><h2 id="wz-saved-title"><?php esc_html_e( '本机收藏', 'webzine-material3' ); ?></h2><button class="wz-icon-button" type="button" data-close aria-label="<?php esc_attr_e( '关闭收藏', 'webzine-material3' ); ?>"><?php echo icon( 'close' ); ?></button></div><p class="wz-muted"><?php esc_html_e( '仅保存在此浏览器，不同步至 WordPress 账号。', 'webzine-material3' ); ?></p><div id="wz-saved-list"></div></dialog><?php endif; ?>
<div id="wz-toast" class="wz-toast" role="status" aria-live="polite"></div>
<noscript><div class="wz-noscript"><?php get_search_form(); ?></div></noscript>
<?php wp_footer(); ?></body></html>
