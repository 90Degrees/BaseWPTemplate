<?php get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="container">

				<div class="row">
					<div class="col-sm-12">
						<?php get_template_part( 'content/content', 'page' ); ?>
					</div>
				</div>

			</div>

		</article>

	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
