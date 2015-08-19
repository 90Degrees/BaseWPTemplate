<?php
/*
  Template Name: Property Search
*/

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$restore_filter = (get_query_var('fs') == 'true') ? true : false;
$reset_search = (get_query_var('rs') == 'true') ? true : false;

if (!session_id()) {
    session_start();
}

if (!empty($_POST)) {
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_NUMBER_INT, false);

  $wo_property_type = !empty($_POST['property_type_group']) ? $_POST['property_type_group'] : [];
  if(in_array(-1,$wo_property_type)) {
    $wo_property_type = []; //clear
    $terms = get_terms(['property-type']);
    foreach($terms as $term) {
      $wo_property_type[] = $term->term_id;
    }
  }
  $_SESSION['wo_property_type'] = !empty($wo_property_type) ? $wo_property_type : [];

  $wo_property_location = !empty($_POST['property_location_group']) ? $_POST['property_location_group'] : [];
  if(in_array(-1,$wo_property_location)) {
    $wo_property_location = []; //clear
    $terms = get_terms(['property-location']);
    foreach($terms as $term) {
      $wo_property_location[] = $term->term_id;
    }
  }
  $_SESSION['wo_property_location'] = !empty($wo_property_location) ? $wo_property_location : [];

  $wo_property_size = !empty($_POST['property_size_group']) ? $_POST['property_size_group'] : [];
  if(in_array(-1,$wo_property_size)) {
    $wo_property_size = []; //clear
    $terms = get_terms(['property-size']);
    foreach($terms as $term) {
      $wo_property_size[] = $term->term_id;
    }
  }
  $_SESSION['wo_property_size'] = !empty($wo_property_size) ? $wo_property_size : [];

} else {
  if (!$restore_filter || $reset_search) {
    unset($_SESSION['wo_property_type']);
    unset($_SESSION['wo_property_location']);
    unset($_SESSION['wo_property_size']);
  }

  $wo_property_type = !empty($_SESSION['wo_property_type']) ? $_SESSION['wo_property_type'] : [];
  $wo_property_location = !empty($_SESSION['wo_property_location']) ? $_SESSION['wo_property_location'] : [];
  $wo_property_size = !empty($_SESSION['wo_property_size']) ? $_SESSION['wo_property_size'] : [];
}

$filtered = !empty($wo_property_type) || !empty($wo_property_location) || !empty($wo_property_size) ? true : false;

?><?php get_header(); ?>

  <div class="container" >
    <div class="row">
      <main id="primary" class="col-sm-12 property-search-container" role="main">

        <header class="index-header">
          <h1 class="index-title news">Property Search</h1>
        </header>

        <?php include_once realpath(__DIR__.'/../partials/property-search.php'); ?>

        <?php
          $tax_query = [];
          if (!empty($wo_property_type)) {
            $tax_query[] = [
              'taxonomy' => 'property-type',
              'field' => 'term_id',
              'terms' => $wo_property_type,
            ];
          }
          if (!empty($wo_property_location)) {
            $tax_query[] = [
              'taxonomy' => 'property-location',
              'field' => 'term_id',
              'terms' => $wo_property_location,
            ];
          }
          if (!empty($wo_property_size)) {
            $tax_query[] = [
              'taxonomy' => 'property-size',
              'field' => 'term_id',
              'terms' => $wo_property_size,
            ];
          }
          if (count($tax_query) > 1) {
            $tax_query['relation'] = 'AND';
          }

          $args = [
            'post_type' => 'property',
            'paged' => $paged,
            'posts_per_page' => 12,
            'tax_query' => $tax_query,
          ];
          $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()) : ?>

          <div class="row property-search-results">
            <?php
              while ($the_query->have_posts()) : $the_query->the_post();
                $search_results = true;
                include locate_template('content/content-property.php');
              endwhile;
            ?>
          </div>

          <?php
            if (function_exists(_90d_custom_pagination)) {
              _90d_custom_pagination($the_query->max_num_pages, '', $paged, $filtered, 'navigation posts-footer');
            }
          ?>
          <?php wp_reset_postdata(); ?>

        <?php else : ?>
          <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

      </main>
    </div>
  </div>

<?php get_footer(); ?>
