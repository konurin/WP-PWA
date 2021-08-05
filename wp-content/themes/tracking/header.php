<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="masthead" class="header">
        <div class="container">
            <div class="header__inner">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logotype">
                    Tracking App
                </a>
                <div class="header__right">
					<?php if ( is_user_logged_in() ): ?>
                        <div class="header__login">
                            <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>"
                               class="logout"><?php esc_html_e( 'Logout', 'tracking' ); ?></a>
                        </div>
                        <div class="header__add">
                            <a href="<?php echo esc_url( home_url( '/add-new-task/' ) ); ?>">+</a>
                        </div>
					<?php else: ?>
                        <div class="header__login">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Login', 'tracking' ); ?></a>
                            <span>/</span>
                            <a href="<?php echo esc_url( home_url( '/?registration=true' ) ); ?>"><?php esc_html_e( 'Registration', 'tracking' ); ?></a>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
