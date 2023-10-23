<?php
/*
Template Name: Blog
Template Post Type: page
*/
?>
<?php wp_head(); ?>

<section id="blog" class="section">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title_blog1', 45); ?></span>
    <span class="title2"><?php the_field('title_blog1', 45); ?></span>
  </h2>
  <ul class="recent_list">

    <!-- add posts items to blog section   -->
    <?php
    global $post;

    $myposts = get_posts([
      'numberposts' => 3,
      'category'    => 7,
      'orderby'     => 'date',
    ]);

    foreach ($myposts as $post) {
      setup_postdata($post);
    ?>

      <li class="recent_item">
        <article class="post">
          <div class="image_wrap blog_mod"><?php the_post_thumbnail(array(400, 300), array('class' => 'img blog_mod')); ?></div>
          <h2 class="post_title">
            <a href="<?php the_permalink(); ?>" class="post_link"><?php the_title(); ?></a>
          </h2>
          <div class="post_text">
            <p><?php the_excerpt(); ?></p>
          </div>
          <a href="#" class="post_date">
            <span class="post_d_day"><?php the_time('j'); ?></span>
            <span class="post_d_month"><?php the_time('M'); ?></span>
          </a>
          <div class="post_stat_wrap">
            <a href="#views" class="post_stat views_mod"><?php echo get_post_meta($post->ID, 'views', true); ?></a>
            <a href="#comments" class="post_stat comm_mod"><?php comments_number(); ?></a>
          </div>
        </article>
      </li>

    <?php
    }
    wp_reset_postdata();
    ?>

  </ul>
</section>

<?php wp_footer(); ?>