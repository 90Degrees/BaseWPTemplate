<?php
	$thumbnail_size = 'news-featured';
	$thumbnail_args = [
		'class' => "img-responsive post-thumbnail",
		'alt'   => get_the_title()
	];

	if(!is_single()) {
		$post_class = $first_post ? "first-post col-sm-12" : "col-sm-4 post-i-{$post_number}";
		if($paged > 1) {
			$post_class = "col-sm-6 col-md-3";
		}
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<div class="post-inner">

		<header class="entry-header">
			<?php if ( is_single() ) { ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<div class="entry-meta">
						<?php the_time('jS F Y'); ?>
					</div>
			<?php } else {
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), get_the_title() ), '</a></h2>' );
			} ?>
		</header><!-- .entry-header -->

		<?php if ( is_single() && has_post_thumbnail() ) { ?>
			<div class="row">
				<div class="col-sm-12">
					<?php the_post_thumbnail($thumbnail_size, $thumbnail_args); ?>
				</div>
			</div>
		<?php } ?>

		<div class="row">

			<?php if ( !is_single() && has_post_thumbnail() && $first_post ) { ?>
				<div class="col-sm-7">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumbnail_size, $thumbnail_args); ?></a>
				</div>
				<div class="entry-excerpt col-sm-5">
					<div class="entry-meta">
						<?php the_time('jS F Y'); ?>
					</div>
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<?php if ( !is_single() && has_post_thumbnail() && !$first_post ) { ?>
				<div class="col-sm-12">
					<div class="entry-excerpt">
						<div class="entry-meta">
							<?php the_time('jS F Y'); ?>
						</div>
						<?php the_excerpt(); ?>
					</div>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php the_post_thumbnail($thumbnail_size, $thumbnail_args); ?>
					</a>
				</div>
			<?php } ?>

			<?php if ( !is_single() && !has_post_thumbnail() ) { ?>
				<div class="entry-excerpt col-sm-12">
					<div class="entry-meta">
						<?php the_time('jS F Y'); ?>
					</div>
					<?php the_excerpt(); ?>
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
