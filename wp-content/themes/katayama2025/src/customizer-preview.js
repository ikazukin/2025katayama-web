/**
 * カスタマイザー リアルタイムプレビュー
 * Issue 18 - トップページのカスタマイザー統合
 */

(function($) {
  'use strict';

  // Hero Section
  wp.customize('hero_title', function(value) {
    value.bind(function(newval) {
      $('.hero-section h1').text(newval);
    });
  });

  wp.customize('hero_subtitle', function(value) {
    value.bind(function(newval) {
      $('.hero-section p').first().html(newval.replace(/\n/g, '<br>'));
    });
  });

  wp.customize('hero_cta_text', function(value) {
    value.bind(function(newval) {
      $('.hero-section .inline-block').text(newval);
    });
  });

  wp.customize('hero_cta_link', function(value) {
    value.bind(function(newval) {
      $('.hero-section .inline-block').attr('href', newval);
    });
  });

  // Features Section
  for (let i = 1; i <= 3; i++) {
    wp.customize(`feature_${i}_title`, function(value) {
      value.bind(function(newval) {
        $(`.feature-card:eq(${i - 1}) h3`).text(newval);
      });
    });

    wp.customize(`feature_${i}_description`, function(value) {
      value.bind(function(newval) {
        $(`.feature-card:eq(${i - 1}) p`).html(newval.replace(/\n/g, '<br>'));
      });
    });
  }

  // Services Section
  for (let i = 1; i <= 4; i++) {
    wp.customize(`service_${i}_title`, function(value) {
      value.bind(function(newval) {
        $(`.service-card:eq(${i - 1}) h3`).text(newval);
      });
    });

    wp.customize(`service_${i}_link`, function(value) {
      value.bind(function(newval) {
        $(`.service-card:eq(${i - 1})`).attr('href', newval);
      });
    });
  }

  // Recruit Section
  wp.customize('recruit_title', function(value) {
    value.bind(function(newval) {
      $('.recruit-section h2').text(newval);
    });
  });

  wp.customize('recruit_text', function(value) {
    value.bind(function(newval) {
      $('.recruit-section .prose').html(newval);
    });
  });

  wp.customize('recruit_cta_text', function(value) {
    value.bind(function(newval) {
      $('.recruit-section .inline-block').text(newval);
    });
  });

  wp.customize('recruit_cta_link', function(value) {
    value.bind(function(newval) {
      $('.recruit-section .inline-block').attr('href', newval);
    });
  });

})(jQuery);
