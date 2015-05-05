<?php
require_once "vendor/autoload.php";
use Feng\BaiduMusic\BaiduMusic;
$b = new BaiduMusic();
$r = $b->getLinks( 1038302 );
print_r( $r );
