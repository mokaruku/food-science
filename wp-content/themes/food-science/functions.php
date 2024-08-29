<?php

// タイムゾーン設定

use function FakerPress\register;

function my_timezone()
{
  date_default_timezone_set('Asia/Tokyo');
}
add_action('after_setup_theme', 'my_timezone');

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
// タイトルタグを有効化する
add_theme_support('title-tag');
// アイキャッチ画像を有効化する
add_theme_support('post-thumbnails');
// メニューを有効化する
add_theme_support('menus');

// エディタースタイルを有効化する
add_theme_support('editor-styles');
add_editor_style('assets\css\editor-style.css');
}

// titleタグの区切り文字を変更する
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator)
{
  $separator = '|';
  return $separator;
}
// Contact Form 7の出力の際にPタグが勝手に入らないようにする
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}
// ショートコードテスト
// ショートコード用関数
// $test = [
//   'text' => 'あいうえお',
//   'link' => 'https://google.co.jp',
// ];
function shortcode_test($test, $content = null)
{
  $default = [
    'text' => 'テキスト',
    'link' => '',
  ];
  $test = shortcode_atts($default, $test);
  $html = $content . 'ショートコードテスト' . $test['text'] . "({$test['link']})";
  return $html;
}
// ショートコードの登録
// add_shortcode('ショートコード名', '呼び出す関数名');
add_shortcode('sc-test', 'shortcode_test');
/**
 * メインクエリを変更する
 */
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  // 管理画面、メインクエリ以外は実行しない
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  // トップページ
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}


/**
 * パスワード保護中のページのタイトルから「保護中」の文字を削除する
 * 
 */
add_filter('protected_title_format', 'my_protected_title');
function my_protected_title()
{
  return '%s';
}

/**
 * パスワード保護フォームをカスタマイズする
 */
function my_password_form()
{
  remove_filter('the_content', 'wpautop');

  $wp_login_url = wp_login_url();
  $html = <<<HTML
  <p>パスワードを入力してください。</p>
  <form action="{$wp_login_url}" class="post-password-form" method="post">
    <input name="post_password" type="password">
    <input type="submit" name="Submit" value="送信">
</form>
HTML;

  return $html;
}
add_filter('the_password_form', 'my_password_form');


