<?php

// タイトルタグを有効化する
add_theme_support('title-tag');

// アイキャッチ画像を有効化する
add_theme_support('post-thumbnails');

//menuを有効化するカスタムメニュー機能を使用可能にする
add_theme_support('menus');

// titleタグの区切り文字を変更する
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator)
{
  $separator = '|';
  return $separator;
}

// ContactForm7の出力の際にｐタグが勝手に入らないようにする
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}


//ショートコードテスト
//ショートコード用関数

// $test = [
//   'text' => 'あいうえお',
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

//ショートコードの登録
//add_shortcode('ショートコード名', '呼び出す関数名');
add_shortcode('sc-test', 'shortcode_test');


/**
 * メインクエリを変更する
 */
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  //管理画面、メインクエリ以外には設定しない
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  //トップページの場合
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}