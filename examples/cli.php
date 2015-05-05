<?php
require_once __DIR__ . "/../src/Feng/BaiduMusic/BaiduMusic.php";

use Feng\BaiduMusic\BaiduMusic;

function ask( $q = "" ) {
	if ( !empty( $q ) ) echo $q;
	return trim( fgets( STDIN ) );
}

function say( $something ) { // I'm giving up on you...
	echo "$something\n";
}

$api = new BaiduMusic();

$keywords = ask( "客官想要什么歌？" );
$result = $api->search( $keywords );

if ( $result === false || !count( $result['song'] ) ) {
	say( "神马都找不到的说。。。换个关键词试试？" );
	exit;
}

say( "恩，看看找到了些什么。。。" );
foreach ( $result['song'] as $key => $value ) {
	say( "[$key] {$value['artistname']} - {$value['songname']} (ID: {$value['songid']})" );
}

$key = ask( "要选哪个呢？" );
$id = $result['song'][$key]['songid'];

$result = $api->getLinks( $id );

if ( $result == false ) {
	say( "诶，有这首歌却没有资源链接什么鬼。。。反正就是不行啦，我先走啦(嫌弃脸" );
	exit;
}

say( "链接都在这了，自己低调下载吧，总之不要玩脱了就好：" );
foreach ( $result['songList'] as $value ) {
	say( "{$value['format']} -> {$value['songLink']}" );
}

