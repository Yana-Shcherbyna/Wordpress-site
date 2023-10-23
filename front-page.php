<?php get_header(); ?>

<div class="wrapper">
  <div class="base">
    <section id="home" class="section intro_mod custom-background">
      <h2 class="section_title intro_mod">
        <span class="title1 intro_mod"><?php the_field('title1'); ?></span>
        <span class="title2 intro_mod"><?php the_field('title2'); ?></span>
      </h2>
    </section>

    <!-- add ABOUT-page, SERVICE-page, WHAT WE DO(SECTION)-page, TEAM-page, TESTIMONIALS-page and home-page sections -->
    <?php
    $my_posts = get_posts(array(
      'meta_key'     => '_wp_page_template',
      'post_type'   => 'page',
    ));

    global $post;

    foreach ($my_posts as $post) {
      setup_postdata($post);
    }

    include(get_query_template('page-about'));
    include(get_query_template('page-service'));
    include(get_query_template('page-section'));
    include(get_query_template('page-team'));

    $post_objects = get_field('choice_user', 423);

    if ($post_objects) {
      include(get_query_template('page-testimonials'));
    };
    include(get_query_template('home'));

    wp_reset_postdata();
    ?>

  </div>

  <?php get_footer(); ?>