<?php
/**
 * Template Name: Login Homepage
 */

    // footer navigation
    $footer_menu_items = vikinger_menu_get_items('footer_menu')['threaded'];
    $footer_menu_items = vikinger_menu_group_by_parent($footer_menu_items);

    // footer bottom text
    $footer_bottom_left_text = get_theme_mod('vikinger_footer_setting_bottom_left_text', false);
    $footer_bottom_right_text = get_theme_mod('vikinger_footer_setting_bottom_right_text', false); 
 
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if (has_site_icon()) : ?>
  <!-- favicon -->
  <link rel="icon" href="<?php site_icon_url(); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ERROR SECTION -->
  <div class="error-section">
    <!-- ERROR SECTION TITLE -->
    <p class="error-section-title">404</p>
    <!-- /ERROR SECTION TITLE -->

    <!-- ERROR SECTION INFO -->
    <div class="error-section-info">
      <!-- ERROR SECTION SUBTITLE -->
      <p class="error-section-subtitle">啥都没有</p>
      <!-- /ERROR SECTION SUBTITLE -->

      <!-- ERROR SECTION TEXT -->
      <p class="error-section-text">似乎找不到这个链接有什么？！要不返回一下~</p>
      <!-- /ERROR SECTION TEXT -->

      <!-- ERROR SECTION TEXT -->
      <p class="error-section-text">如果您还有其他问题，请发送邮件：<code>support#nurltech.eu.org</code> ["#"=>"@"]</p>
      <!-- /ERROR SECTION TEXT -->

      <!-- BUTTON -->
      <a class="button medium primary" href="javascript:window.history.back();">返回</a>
      <!-- /BUTTON -->
    </div>
    <!-- /ERROR SECTION INFO -->
  </div>
  <!-- /ERROR SECTION -->



<?php wp_footer(); ?>
  
</body>
</html>