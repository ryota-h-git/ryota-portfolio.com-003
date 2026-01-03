<?php

function my_setup() {
  add_theme_support('post-thumbnails');
}
add_action("after_setup_theme", "my_setup");

// CSS読み込み
function my_enqueue_styles() {
  // メインCSS
  wp_enqueue_style(
    "my-style",
    get_template_directory_uri() . "/public/assets/css/style.min.css",
    array(),
    filemtime(get_theme_file_path('public/assets/css/style.min.css')),
    "all"
  );

  // Swiper
  wp_enqueue_style(
    'swiper-style',
    get_template_directory_uri() . '/public/assets/vendor/swiper/swiper-bundle.min.css',
    array(),
    filemtime(get_theme_file_path('/public/assets/vendor/swiper/swiper-bundle.min.css')),
    'all'
  );

  // Font Awesome
  wp_enqueue_style(
    'font-awesome',
    'https://use.fontawesome.com/releases/v6.5.0/css/all.css',
    array(),
    null,
    'all'
  );

}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');

// Google Fonts
function mytheme_enqueue_google_fonts() {
  wp_enqueue_style(
    'mytheme-google-fonts',
    'https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&family=Shippori+Mincho&display=swap',
    array(),
    null
  );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_google_fonts');


// JS読み込み
function my_enqueue_scripts() {
  // Swiper
  wp_enqueue_script(
    'swiper-js',
    get_template_directory_uri() . '/public/assets/vendor/swiper/swiper-bundle.min.js',
    array(),
    null,
    true
  );

  // SplitType
  wp_enqueue_script(
    'split-type',
    'https://unpkg.com/split-type',
    array(),
    null,
    true
  );

  // GSAP
  wp_enqueue_script(
    'gsap',
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
    array(),
    '3.12.5',
    true
  );

  // GSAP ScrollTrigger
  wp_enqueue_script(
    'gsap-scrolltrigger',
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
    array('gsap'),
    '3.12.5',
    true
  );

  // GSAP MotionPathPlugin
wp_enqueue_script(
  'gsap-motionpath',
  'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js',
  array('gsap'),
  '3.12.5',
  true
);


  // jQuery（WordPress同梱版を利用）
  wp_enqueue_script('jquery');

  // 自作script.js
  wp_enqueue_script(
    'theme-script',
    get_template_directory_uri() . '/public/assets/js/script.min.js',
    array('jquery', 'swiper-js', 'gsap'),
    filemtime(get_theme_file_path('public/assets/js/script.min.js')),
    true
  );
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

// CF7 自動pタグ削除
add_filter('wpcf7_autop_or_not', '__return_false');




