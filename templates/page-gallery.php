<?php
/*
  Template Name: Gallery
*/
?>
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

      <?php
        $images = get_field('gallery');

        if( $images ): ?>

        <div class="gallery-carousel">

          <div class="images">
            <?php foreach( $images as $image ): ?>

              <a href="<?php echo $image['url']; ?>" data-lightbox="gallery">
                <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              </a>

            <?php endforeach; ?>
          </div>
          <span class="next-arrow">Next Image</span>
          <span class="prev-arrow">Prev Image</span>
        </div>

      <?php endif; ?>

      </article>

    <?php endwhile; ?>
  </main>

<?php get_footer(); ?>
