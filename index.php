<?php get_header(); ?>

  <div class="container" >
    <div class="row">

      <main id="primary" class="col-sm-12" role="main">

        <header class="index-header">
          <h1 class="index-title news"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">News</a></h1>
        </header>

        <?php if ( have_posts() ) : ?>

          <div class="post-index-container">
            <div class="row">
              <?php
                $post_number = 0;
                $first_post = false;
              	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                if(isset($post_number) && $post_number == 0 && $paged == 1) {
              		$first_post = true;
              	}

                while ( have_posts() ) : the_post();
                  include(locate_template('content/content.php'));
                  if(isset($post_number) && $post_number == 0 && $paged == 1) {
                    echo '</div><div class="row">';
                    $first_post = false; //reset now we've used this
                	}
                  $post_number++;
                endwhile;
              ?>
            </div>
          </div>

          <nav class="navigation posts-footer">
            <div class="nav-previous"><?php next_posts_link( '&lt; Older posts' ); ?></div>
            <div class="nav-next"><?php previous_posts_link( 'Newer posts &gt;' ); ?></div>
          </nav>

        <?php else : ?>

          <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

      </main>

    </div>
  </div>

<?php get_footer(); ?>
