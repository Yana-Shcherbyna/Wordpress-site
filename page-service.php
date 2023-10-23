<?php
/*
Template Name: Service
Template Post Type: page
*/
?>

<?php wp_head(); ?>

<section id="service" class="section">
  <h2 class="section_title">
    <span class="title1"><?php the_field('title1'); ?></span>
    <span class="title2"><?php the_field('title1'); ?></span>
  </h2>
  <ul class="services_list">

    <!-- add service items from ACF fields   -->
    <?php
    $service_list = get_field('service_list', 43);

    if ($service_list) {
      foreach ($service_list as $service_item) {
    ?>

        <li class="services_l_item">
          <div class="service_block <?= get_service_icon_class($service_item["item_icon"]); ?>">
            <h3 class="service_title">
              <?php echo $service_item["item_title"]; ?></h3>
            <div class="service_text">
              <p><?php echo $service_item['item_text']; ?></p>
            </div>
          </div>
        </li>

    <?php
      }
    }
    ?>

  </ul>
</section>

<?php wp_footer(); ?>