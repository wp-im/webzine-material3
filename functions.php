<?php
/** Independent Classic Theme. Shared-source version: 0.1.0. */
namespace Webzine\Material3;
if ( ! defined( 'ABSPATH' ) ) { exit; }
foreach ( array( 'helpers', 'setup', 'customizer', 'menus', 'widgets' ) as $module ) {
	require_once get_theme_file_path( '/inc/' . $module . '.php' );
}
