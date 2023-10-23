<?php
/*
Template Name: Team
Template Post Type: Team
*/
?>

<?php wp_head(); ?>

<section class="section">
  <ul class="team_list">

    <?php
    $args = array(
      'post_type' => 'team',
      'post_status' => 'publish',
      'orderby' => 'title',
      'order' => 'ASC',
    );

    $loop = new WP_Query($args);

    while ($loop->have_posts()) : $loop->the_post();
      setup_postdata($post);
    ?>

      <li class="team_l_item">
        <div class="teammate_block">
          <figure class="image_wrap effect1_mod"><?php the_post_thumbnail(array(380, 470), array('class' => 'img')); ?>
            <figcaption class="image_caption">
              <ul class="teammate_socials">

                <?php
                $social_links = get_field('social_links', $post->ID);

                if ($social_links) {
                  foreach ($social_links as $link) {
                ?>

                    <li class="teammate_s_item">
                      <a href="<?php echo $link['social_link'] ?>" class="teammate_s_link facebook_mod"></a>
                    </li>

                <?php
                  }
                }
                ?>

              </ul>
            </figcaption>
          </figure><span class="image_c_title"><?php the_title(); ?></span><span class="image_c_text"><?php the_field('position'); ?></span>
        </div>
      </li>
    <?php endwhile;
    wp_reset_postdata();
    ?>
  </ul>
</section>

<?php wp_footer(); ?>
