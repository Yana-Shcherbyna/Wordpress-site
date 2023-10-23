<?php
/*
Template Name: About
Template Post Type: page
*/

?>
<?php wp_head(); ?>

<section id="about" class="section">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title_about1', 41); ?></span>
    <span class="title2"><?php the_field('title_about2', 41); ?></span>
  </h2>
  <div class="section_descr"> <?php the_field('about_descr', 41); ?></div>
  <ul class="stories_list">
    
    <!-- Output posts from blog for about section-->
    <?php
    global $post;

    $myposts = get_posts([
      'numberposts' => 3,
      'category'    => 3
    ]);

    if ($myposts) {
      foreach ($myposts as $post) {
        setup_postdata($post);
    ?>

        <li class="stories_l_item">
          <a href="<?php the_permalink(); ?>" class="image_link">
            <figure class="image_wrap effect1_mod"><?php the_post_thumbnail(); ?>
              <figcaption class="image_caption story_mod"><?php the_title(); ?></figcaption>
            </figure>
          </a>
        </li>

    <?php
      }
    }
    wp_reset_postdata();
    ?>

  </ul>
  <ul class="facts_list">

    <?php
    $facts_list = get_field('fact_list', 41);

    if ($facts_list) {
      foreach ($facts_list as $fact_item) {
    ?>

        <li class="facts_l_item">
          <dl class="fact_block">
            <dt class="fact_text"><?php echo $fact_item["fact_text"]; ?></dt>
            <dd class="fact_num"><?php echo $fact_item['fact_number']; ?></dd>
          </dl>
        </li>

    <?php
      }
    }
    ?>

  </ul>
</section>

<?php wp_footer(); ?>