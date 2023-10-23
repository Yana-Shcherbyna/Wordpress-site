<?php
/*
Template Name: Section
Template Post Type: page
*/
?>

<?php wp_head(); ?>

<section class="section">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title_we_do1', 295); ?></span>
    <span class="title2"><?php the_field('title_we_do2', 295); ?></span>
  </h2>
  <div class="section_descr">
    <p><?php the_field('we_do_descr', 295); ?></p>
  </div>
  <div class="what">
    <figure class="image_wrap what_mod"><img src="<?php the_field('section_img', 295); ?>" class="img"></figure>
    <ul class="accordion">

      <!-- add accordion items from ACF fields   -->
      <?php
      $accordion = get_field('accordion', 295);

      if ($accordion) {
        foreach ($accordion as $accordion_item) {
      ?>

          <li class="accordion_item">
            <h3 class="accordion_title <?= get_service_icon_class($accordion_item["accordion_icon"]); ?>"><?php echo $accordion_item["accordion_title"]; ?></h3>
            <div class="accordion_content">
              <p><?php echo $accordion_item['accordion_text']; ?></p>
            </div>
          </li>

      <?php
        }
      }
      ?>

    </ul>
  </div>
</section>

<?php wp_footer(); ?>