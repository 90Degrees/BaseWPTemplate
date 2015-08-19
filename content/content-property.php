<?php
	if(is_single()) {
		$post_class = "col-sm-12";
	} else {
		$post_class = "col-xs-6 col-sm-3";
	}

	$property_type = get_field("property_type");
	$property_location = get_field("property_location");
	$property_size_range = get_field("property_size_range");
	$property_size = get_field("property_size");
	$thumbnail = get_field("thumbnail");
	if(!empty($thumbnail)) {
		$thumbnail_src = $thumbnail['sizes']['property-thumbnail'];
	}
	$gallery = get_field("gallery");
	$location = get_field("location");
	$floor_plans = get_field("floor_plans");
	$availability_areas = get_field("availability_areas");
	$brochure = get_field("brochure");
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<div class="post-inner">

		<header class="entry-header">
			<?php if ( is_single() ) { ?>

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<?php } else {

				if(!empty($thumbnail_src)) {
					echo sprintf( '<a href="%s" rel="bookmark" title="%s" class="property-thumbnail"><img class="img-responsive" alt="%s" src="%s" /></a>', esc_url( get_permalink() ), get_the_title(), get_the_title(), $thumbnail_src );
				}
				the_title( sprintf( '<h2 class="property-title"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), get_the_title() ), '</a></h2>' );

			} ?>
		</header>

		<div class="row">

			<?php if ( !is_single() ) { ?>
				<div class="col-sm-12">
					<div class="property-size">
						<p><?php echo $property_size; ?></p>
					</div>
				</div>
			<?php } ?>

			<?php if ( is_single() ) { ?>
				<div class="entry-content col-sm-12">
					<?php the_content( sprintf(__( 'Continue reading %s', '_90d' ), the_title( '<span class="screen-reader-text">', '</span>', false )) ); ?>
				</div>
			<?php }?>

		</div>

		<footer class="entry-footer">
		</footer>

	</div>
</article>
