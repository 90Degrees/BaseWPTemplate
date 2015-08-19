<?php get_header(); ?>

  <div class="container">

      <main id="primary" role="main">

        <div class="row">
          <header class="index-header col-sm-12">
            <h1 class="index-title news"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">News</a></h1>
          </header>
        </div>

        <div class="row">
          <div class="col-sm-9 single-content">

            <?php if ( have_posts() ) : ?>

              <?php
                while ( have_posts() ) : the_post();
                  get_template_part( 'content/content', get_post_format() );
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

          <aside class="col-sm-3 single-sidebar">
            <?php get_sidebar(); ?>
          </aside>
        </div>

      </main>

    </div>
  </div>

<?php get_footer(); ?>
