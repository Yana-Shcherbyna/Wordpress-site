<?php
/*
Template Name: Testimonials
Template Post Type: Testimonials
*/
?>

<?php wp_head(); ?>

<div class="clients">

  <?php
  $args = array(
    'post_type' => 'testimonials',
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
  );

  $loop = new WP_Query($args);

  while ($loop->have_posts()) : $loop->the_post();
    setup_postdata($post);
  ?>

    <div class="client_block">
      <div class="client_image"><?php the_post_thumbnail(array(110, 117), array('class' => 'img')); ?></div>
      <div class="text_wrap">
        <div class="image_c_title"><?php the_title(); ?></div>
        <div class="image_c_text"><?php the_field('position_testimonials'); ?></div>
        <div class="text">
          <p><?php the_content(); ?></p>
        </div>
      </div>
    </div>

  <?php endwhile;
  wp_reset_postdata();
  ?>

</div>

<?php wp_footer(); ?>