<?php
/*
  Template Name: Services
*/
?>
<?php get_header(); ?>

<main id="main" class="site-main" role="main">

  <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('page-services'); ?>>

      <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header>

      <?php if( have_rows("services") ): ?>

        <div class="services-tabs">

          <ul class="nav nav-tabs" role="tablist">
            <?php $i = 0; ?>
            <?php while( have_rows("services") ): the_row(); ?>
              <li role="presentation" class="<?php if($i == 0) { echo 'active'; } ?>">
                <a href="#service_<?php echo $i; ?>" aria-controls="service_<?php echo $i; ?>" role="tab" data-toggle="tab">
                  <?php echo get_sub_field("service_title"); ?>
                </a>
              </li>
              <?php $i++; ?>
            <?php endwhile; ?>
          </ul>

          <div class="tab-content">
            <?php $i = 0; ?>
            <?php while( have_rows("services") ): the_row(); ?>
              <?php
                $bg_image = get_sub_field("service_background_image");
              ?>
              <div role="tabpanel" class="tab-pane fade <?php if($i == 0) { echo 'in active'; } ?>"
                id="service_<?php echo $i; ?>"
                style="background-image:url(<?php echo $bg_image['sizes']['page-backgroud']; ?>)">

                <div class="container">
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="service-content">
                        <h2><?php echo get_sub_field("service_title"); ?></h2>
                        <?php echo get_sub_field("service_content"); ?>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <?php $i++; ?>
            <?php endwhile; ?>
          </div>

        </div>

      <?php endif; ?>
    </article>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
