<?php
/*
  Template Name: Contact
*/
?>
<?php get_header(); ?>

<main id="main" class="site-main" role="main">


  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('page-contact'); ?>>

      <div class="container">

        <div class="row">
        	<header class="entry-header col-sm-12">
        		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        	</header>
        </div>

        <?php if( have_rows("contacts") ): ?>
          <div class="row">
            <div class="col-sm-12">

              <div class="contacts-table">

                <?php while( have_rows("contacts") ): the_row(); ?>
                  <div class="contact">
                    <h3><?php echo get_sub_field("contact_name"); ?></h3>
                    <?php echo get_sub_field("contact_details"); ?>
                  </div>
                <?php endwhile; ?>

              </div>

            </div>
          </div>
        <?php endif; ?>





        <div class="row">
          <div class="entry-content col-sm-12">
        		<?php the_content(); ?>
        	</div>
        </div>

        <div class="row">
          <div class="contact-map col-sm-12">

            <?php $contact_map = get_field('contact_map'); ?>
            <?php if( !empty($contact_map) ): ?>
              <div class="acf-map">
              	<div class="marker" data-lat="<?php echo $contact_map['lat']; ?>" data-lng="<?php echo $contact_map['lng']; ?>"></div>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>

    </article>

  <?php endwhile; ?>
</main>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<?php get_footer(); ?>
