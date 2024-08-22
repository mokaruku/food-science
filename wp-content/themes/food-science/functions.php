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

