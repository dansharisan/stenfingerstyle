<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

get_header(); ?>

<section id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php if ( siteorigin_page_setting( 'page_title' ) ) : ?>
				<h1 id="page-title"><?php printf( __( 'Search Results for: <b>%s</b>', 'vantage' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			<?php endif; ?>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div style="background: #d3d3d3; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
			<?php get_template_part( 'content' ); ?>
		</div>
		<?php endwhile; ?>

		<?php vantage_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

	</div><!-- #content .site-content -->
</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>