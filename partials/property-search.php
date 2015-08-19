<form class="row property-search-toolbar" action="/properties" method="POST">

  <div class="col-sm-10">

    <div class="row">

      <div class="col-sm-4">
        <div class="property-search-selection">
          <span class="title">Type:</span>
          <span class="search"><i class="glyphicon glyphicon-menu-down"></i> Select</span>
          <label for="property_type_group_all">
            <input type="checkbox" name="property_type_group[]" id="property_type_group_all" value="-1" />
            <span>All</span>
          </label>
          <?php $terms = get_terms(['property-type'], [ 'orderby' => 'id', 'order' => 'DESC' ]); ?>
          <?php foreach($terms as $term) { ?>
            <?php $checked = (!empty($wo_property_type) && in_array($term->term_id, $wo_property_type)) ? 'checked="checked"' : ''; ?>
            <label for="property_type_group_<?php echo $term->term_id; ?>">
              <input type="checkbox" name="property_type_group[]" id="property_type_group_<?php echo $term->term_id; ?>" value="<?php echo $term->term_id; ?>" <?php echo $checked; ?> />
              <span><?php echo $term->name; ?></span>
            </label>
          <?php } ?>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="property-search-selection">
          <span class="title">Location:</span>
          <span class="search"><i class="glyphicon glyphicon-menu-down"></i> Select</span>
          <label for="property_location_group_all">
            <input type="checkbox" name="property_location_group[]" id="property_location_group_all" value="-1" />
            <span>All</span>
          </label>
          <?php $terms = get_terms(['property-location'], [ 'orderby' => 'id', 'order' => 'DESC' ]); ?>
          <?php foreach($terms as $term) { ?>
            <?php $checked = (!empty($wo_property_location) && in_array($term->term_id, $wo_property_location)) ? 'checked="checked"' : ''; ?>
            <label for="property_location_group_<?php echo $term->term_id; ?>">
              <input type="checkbox" name="property_location_group[]" id="property_location_group_<?php echo $term->term_id; ?>" value="<?php echo $term->term_id; ?>" <?php echo $checked; ?> />
              <span><?php echo $term->name; ?></span>
            </label>
          <?php } ?>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="property-search-selection">
          <span class="title">Size:</span>
          <span class="search"><i class="glyphicon glyphicon-menu-down"></i> Select</span>
          <label for="property_size_group_all">
            <input type="checkbox" name="property_size_group[]" id="property_size_group_all" value="-1" />
            <span>All</span>
          </label>
          <?php $terms = get_terms(['property-size'], [ 'orderby' => 'id', 'order' => 'DESC' ]); ?>
          <?php foreach($terms as $term) { ?>
            <?php $checked = (!empty($wo_property_size) && in_array($term->term_id, $wo_property_size)) ? 'checked="checked"' : ''; ?>
            <label for="property_size_group_<?php echo $term->term_id; ?>">
              <input type="checkbox" name="property_size_group[]" id="property_size_group_<?php echo $term->term_id; ?>" value="<?php echo $term->term_id; ?>" <?php echo $checked; ?> />
              <span><?php echo $term->name; ?></span>
            </label>
          <?php } ?>
        </div>
      </div>

    </div>

  </div>

  <div class="col-sm-2 search-submit">
    <button type="submit" class="btn btn-blue btn-search" />
      Search
      <i class="glyphicon glyphicon-menu-down"></i>
    </button>
    <a href="/properties/?rs=true" title="Reset Search" class="reset-search">Reset search</a>
  </div>

  <div class="col-sm-12">
    <span class="property-freetext">
      <input type="text" name="property_freetext" id="property_freetext" class="input-text" placeholder="Or type a search here" />
      <i class="glyphicon glyphicon-search"></i>
    </span>
  </div>


</form>
