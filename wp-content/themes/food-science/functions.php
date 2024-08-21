<?php
//title-tagを有効化する
add_theme_support('title-tag');

//アイキャッアイキャッチ画像を使用可能にする
add_theme_support('post-thumbnails');

//<title>タグの区切り文字を変更する 
add_filter('document_title_separator', 
'my_document_title_separator');
function my_document_title_separator($separator) 
{ 
$separator = '|';
return $separator;
}

