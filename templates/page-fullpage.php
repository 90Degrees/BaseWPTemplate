<?php
/*
  Template Name: Full Page Layout with multiple sections
*/
?>
<?php get_header(); ?>

<main id="main" class="site-main" role="main">


  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('park-team-page'); ?>>

      <div class="container">

        <div class="row">
        	<header class="entry-header col-sm-12">
        		<?php the_title( '<h1 class="entry-title park-team">', '</h1>' ); ?>
        	</header>
        </div>

        <div class="row">
          <div class="entry-content col-sm-12">
        		<?php the_content(); ?>
        	</div>
        </div>

      </div>

      <?php
        $people = get_posts([
          'post_type' => 'person',
          'posts_on_page' => -1
        ]);
      ?>

      <?php if($people) { ?>
        <div class="container people-container">
          <div class="row">
          <?php foreach($people as $person) { ?>
            <div class="person col-sm-4">
              <h2><?php echo get_the_title($person->ID); ?></h2>

              <?php $job_title = get_field('job_title', $person->ID); ?>
              <?php if($job_title) { ?><div class='person-job-title'><?php echo $job_title; ?></div><?php } ?>

              <?php $bio = get_field('bio', $person->ID); ?>
              <?php if($bio) { ?><div class='person-bio'><?php echo $bio; ?></div><?php } ?>

            </div>
          <?php } ?>
          </div>
        </div>
      <?php } ?>
      <?php wp_reset_query(); ?>

      <?php get_template_part( 'partials/tab', 'groups-content' ); ?>


    </article>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
