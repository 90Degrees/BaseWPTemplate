<?php
/*
  Template Name: Home
*/
?>
<?php get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="home-content">
        <?php the_content(); ?>
			</div>

      <?php
        $carousel_count = count(get_field("home_carousel_images"));
      ?>
      <?php if( have_rows("home_carousel_images") ): ?>

        <div id="home_carousel" class="carousel slide fade-carousel" data-ride="carousel">

          <ol class="carousel-indicators">
            <?php for($i = 0; $i<$carousel_count; $i++) { ?>
              <li data-target="#home_carousel" data-slide-to="<?php echo $i; ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
            <?php } ?>
          </ol>

          <div class="carousel-inner" role="listbox">

            <?php $i = 0; ?>
            <?php while( have_rows("home_carousel_images") ): the_row(); ?>

              <?php
                $carousel_image = get_sub_field("carousel_image");
              ?>
              <?php /* <div class="section parallax-window" id="home_section_<?php echo $i; ?>"
                data-parallax="scroll" data-bleed="200"
                data-speed="<?php echo get_sub_field("section_parallax_scroll_speed"); ?>"
                data-image-src="<?php echo $bg_image['sizes']['page-backgroud']; ?>"
                data-natural-width="<?php echo $bg_image['sizes']['page-backgroud-width']; ?>"
                data-natural-height="<?php echo $bg_image['sizes']['page-backgroud-height']; ?>">

                <div class="section-content">
                  <?php echo get_sub_field("section_content"); ?>

                  <?php if($i < $carousel_count - 1) { ?>
                    <div class="section-nav">
                      <i class="icon-arrow-down"></i>
                    </div>
                  <?php } ?>
                </div>

              </div>

              <?php if($i < $carousel_count - 1) { ?>
                <div class="section parallax-separator"></div>
              <?php } else { ?>
                <div class="section parallax-separator parallax-separator-page-nav"><?php echo _90d_page_nav(false, true); ?></div>
              <?php } ?>
              */ ?>

              <div class="item <?php if($i==0) { ?>active<?php } ?>" style="background-image:url(<?php echo $carousel_image['sizes']['page-backgroud']; ?>)"></div>

              <?php $i++; ?>
            <?php endwhile; ?>

          </div>
          <div class="parallax-page-nav">
              <div class="parallax-page-nav-inner"><?php echo _90d_page_nav(false, true); ?></div>
          </div>

        </div>

      <?php endif; ?>

    </article>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
