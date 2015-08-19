/*!
Worthington Owen
19-08-2015
*/
'use strict';
$(function() {
  var _90dApp = {

    init: function() {
      console.log("_90dApp init");
    },

    handle_gallery_carousel: function() {

      var gallery_carousel = $(".gallery-carousel .images");
      if (gallery_carousel.length) {

        gallery_carousel.slick({
          dots: true,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear',
          draggable: false,
          autoplay: true,
          autoplaySpeed: 8000,
          nextArrow: '.next-arrow',
          prevArrow: '.prev-arrow'
        });

      }
    },

    render_map: function($el) {

      var $markers = $el.find('.marker');

      var args = {
        zoom: 16,
        center: new google.maps.LatLng(0, 0),
				mapTypeIds: [google.maps.MapTypeId.ROADMAP]
      };

      var map = new google.maps.Map($el[0], args);
      map.markers = [];

      $markers.each(function() {
        _90dApp.add_marker($(this), map);
      });

			map.setOptions({styles: _90dApp.map_styles});

      _90dApp.center_map(map);

    },

    add_marker: function($marker, map) {

      var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
				animation: google.maps.Animation.DROP,
				icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
      });

      map.markers.push(marker);

    },

    center_map: function(map) {

      var bounds = new google.maps.LatLngBounds();

      $.each(map.markers, function(i, marker) {
        var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
        bounds.extend(latlng);
      });

      if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());
        map.setZoom(15);
      } else {
        map.fitBounds(bounds);
      }

    },

    map_styles: [
			{
				"featureType": "landscape",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 65
					},
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "poi",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 51
					},
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.highway",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 30
					},
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "road.local",
				"stylers": [
					{
            "saturation": -100
          },
          {
            "lightness": 40
          },
          {
            "visibility": "on"
          }
        ]
	    },
	    {
        "featureType": "transit",
        "stylers": [
          {
            "saturation": -100
          },
          {
            "visibility": "simplified"
          }
        ]
	    },
	    {
        "featureType": "administrative.province",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
	    },
	    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
          {
            "visibility": "on"
          },
          {
            "lightness": -25
          },
          {
            "saturation": -100
          }
        ]
	    },
	    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
          {
            "hue": "#ffff00"
          },
          {
            "lightness": -25
          },
          {
            "saturation": -97
          }
        ]
	    }
		],

    handle_maps: function() {

      $('.acf-map').each(function() {
        _90dApp.render_map($(this));
      });

    },

    handle_page_transitions: function() {
      $(".animsition").animsition({
        inClass               :   'fade-in-up',
        outClass              :   'fade-out-up',
        inDuration            :    300,
        outDuration           :    800,
        //linkElement           :   '.animsition-link',
        linkElement   :   'a:not([target="_blank"]):not([href^=#])',
        loading               :    true,
        loadingParentElement  :   'body', //animsition wrapper element
        loadingClass          :   'animsition-loading',
        unSupportCss          : [ 'animation-duration',
                                  '-webkit-animation-duration',
                                  '-o-animation-duration'
                                ],
        //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

        overlay               :   false,

        overlayClass          :   'animsition-overlay-slide',
        overlayParentElement  :   'body'
      });
    }

  };

  _90dApp.init();
  _90dApp.handle_gallery_carousel();
  _90dApp.handle_maps();
  _90dApp.handle_page_transitions();

});
