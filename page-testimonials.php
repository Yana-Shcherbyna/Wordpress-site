<?php
/*
Template Name: TestimonialsMain
Template Post Type: page
*/
?>

<?php wp_head(); ?>

<section class="section what_mod" style="background-image:url('<?php echo get_field('bg-img', 423); ?>')">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title_testimonials1', 423); ?></span>
    <span class="title2"><?php the_field('title_testimonials2', 423); ?></span>
  </h2>
  <div class="clients">

    <!-- add testimonials items from ACF fields   -->
    <?php
    $post_objects = get_field('choice_user', 423);

    if ($post_objects) : foreach ($post_objects as $post) : setup_postdata($post);
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

    <?php
      endforeach;
      wp_reset_postdata();
    endif;
    ?>

  </div>
</section>

<?php wp_footer(); ?>