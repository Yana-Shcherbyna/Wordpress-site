<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <title>Index page</title>
    <meta name="viewport" content="width=device-width"/>

    <?php wp_head(); ?>

  </head >

  <body>
    
    <header class="header">
      <div class="header_main_row">
        <h1 class="logo_wrap header_mod"><a href="#" class="logo_text header_mod">MoGo</a></h1>
      </div>
      <div class="menu_trigger_wrap">
        <div id="menu_trigger" class="menu_trigger"><span class="menu_trigger_decor"></span></div>
      </div>
      <nav class="header_menu_row">
        
        <!-- add nav menu -->
        <?php 
        wp_nav_menu( [
            'theme_location'  => 'header',
            'container'       => false,
            'menu_class'      => 'header_menu_list',
            'echo'            => true,
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            
        ] ); 
        ?>

      </nav>
    </header>