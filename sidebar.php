<?php if ( is_active_sidebar( 'news-widgets' ) ) : ?>
	<div id="news_widgets" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'news-widgets' ); ?>
	</div>
<?php endif; ?>
