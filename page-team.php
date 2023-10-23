<?php
/*
Template Name: TeamMain
Template Post Type: page
*/
?>

<?php wp_head(); ?>

<section class="section">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title_team1', 353); ?></span>
    <span class="title2"><?php the_field('title_team2', 353); ?></span>
  </h2>
  <div class="section_descr">
    <p><?php the_field('team_descr', 353); ?></p>
  </div>
  <ul class="team_list">

    <!-- add team members items from ACF fields   -->
    <?php
    $post_objects = get_field('choice', 353);

    if ($post_objects) : foreach ($post_objects as $post) : setup_postdata($post);
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
                        <a href="<?php echo $link['social_link'] ?>" class="teammate_s_link <?= get_service_icon_class($link["social_link_icon"]); ?>"></a>
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

    <?php
      endforeach;
      wp_reset_postdata();
    endif;
    ?>

  </ul>
</section>

<?php wp_footer(); ?>