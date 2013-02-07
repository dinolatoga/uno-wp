<?php
/**
* Detail Post Template
* @package WordPress
* @subpackage Uno
*/
get_header(); ?>
	<div class="content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; else: ?>
		<h1 class="pagetitle">Post not found</h1>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>