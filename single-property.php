<?php get_header(); ?>

  <div class="container">

      <main id="primary" role="main">

        <div class="row">
          <div class="col-sm-12">

            <?php if ( have_posts() ) : ?>

              <?php
                while ( have_posts() ) : the_post();
                  get_template_part( 'content/content', 'property' );
                endwhile;
              ?>

              <nav class="navigation posts-footer">
                <div class="nav-previous"><?php previous_post_link('%link', '&lt; Previous Post ' ); ?></div>
                <div class="nav-next"><?php next_post_link('%link', 'Next Post &gt;' ); ?></div>
              </nav>

            <?php else : ?>

              <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

          </div>


        </div>

      </main>

    </div>
  </div>

<?php get_footer(); ?>
