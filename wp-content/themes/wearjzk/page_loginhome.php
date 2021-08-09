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
<?php if ( is_user_logged_in() ) : ?>
<meta http-equiv="refresh" content="0; url=/activity" />
<?php endif; ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/../vikinger/css/vklogin-style.css" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<style>
.landing {
    width: 100%;
    height: 100%;
    background: url("https://odindesignthemes.com/vikinger/img/landing/landing-background.jpg") no-repeat 0;
    background-size: cover;
    position: fixed;
    top: 0;
    left: 0;
}

.landing .landing-decoration {
    width: 64%;
    height: 140%;
    border-radius: 50%;
    background: url("https://odindesignthemes.com/vikinger/img/landing/dot-texture.png") repeat 0 0 #fff;
    position: absolute;
    top: -20%;
    right: -32%;
    pointer-events: none;
}
</style>
<div class="landing">

<div class="landing-decoration"></div>

<div class="landing-info">

<div class="logo">

<img src="<?php site_icon_url(); ?>" >

</div>


<h2 class="landing-info-pretitle">加入</h2>


<h1 class="landing-info-title">jzkuwear</h1>


<p class="landing-info-text">看见更丰富的智能穿戴与生活</p>




</div>


<div class="landing-form">

<div class="form-box login-register-form-element" >

<img class="form-box-decoration overflowing" src="https://odindesignthemes.com/vikinger/img/landing/rocket.png" alt="rocket">

<?php if ( !is_user_logged_in() ) : ?>
<h2 class="form-box-title">登录</h2>
<form class="form" action="https://wear.jzku.top/wp-login.php" method="post">

    <?php wp_login_form(); ?>

</form>
<p class="havent-register-yet">
还没有帐号？
<a href="./register/" class="button primary">立即注册</a>
</p>
<p>
<a href="./activity/" class="">随便看看</a>
</p>
<?php else: ?>
<h2 class="form-box-title">欢迎回来！</h2>
<p class="form-box-hint">接下来您将进入广场页面。</p>
<div class="page-loader-indicator loader-bars">
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
    </div>
<?php endif; ?>


</div>

</div>

<div class="landing-footer">
    <?php if ($footer_menu_items > 0) : ?>
      <!-- FOOTER NAVIGATION -->
      <div class="footer-navigation">
      <?php

        foreach ($footer_menu_items as $key => $footer_menu_item) {
          /**
           * Navigation Section
           */
          get_template_part('template-part/navigation/navigation', 'section', [
            'section_name'  => $key,
            'section_links' => $footer_menu_item
          ]);
        }

      ?>
      </div>
      <!-- /FOOTER NAVIGATION -->
    <?php endif; ?>

  <?php

    if ($footer_bottom_left_text || $footer_bottom_right_text) :
      $footer_bottom_left_text = $footer_bottom_left_text ? $footer_bottom_left_text : '';
      $footer_bottom_right_text = $footer_bottom_right_text ? $footer_bottom_right_text : '';
  ?>
    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">
      <!-- FOOTER BOTTOM TEXT -->
      <p class="footer-bottom-text"><?php echo wp_kses($footer_bottom_left_text, ['a' => ['href' => [], 'target' => []]]); ?></p>
      <!-- /FOOTER BOTTOM TEXT -->

      <!-- FOOTER BOTTOM TEXT -->
      <p class="footer-bottom-text"><?php echo wp_kses($footer_bottom_right_text, ['a' => ['href' => [], 'target' => []]]); ?></p>
      <!-- /FOOTER BOTTOM TEXT -->
    </div>
    <!-- /FOOTER BOTTOM -->
  <?php endif; ?>
</div>

</div>


<?php wp_footer(); ?>
  
</body>
</html>