    </div><!-- .body-content -->
    <footer class="site-footer">

      <div class="container">
        <div class="row">
          <div class="col-sm-12">

            <?php if (!is_front_page()) { ?>
            <div class="parallax-page-nav">
              <div class="parallax-page-nav-inner">
                <?php echo _90d_page_nav(false, true); ?>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </footer>

  </section><!-- .site-container -->

  <!--[if lt IE 9]>
    <div class="browser-upgrade alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <p>Your browser is <strong>out of date</strong>. It has known security flaws and may not display all features of this and other websites.</p>
      <p>Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
    </div>
  <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo BOWER_DIR; ?>/jquery/dist/jquery.min.js"><\/script>')</script>
  <script src="<?php echo JS_DIR; ?>/vendor.js"></script>
  <script src="<?php echo JS_DIR; ?>/app.js"></script>
  <?php wp_footer(); ?>
</body>
</html>
