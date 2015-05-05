<?php
namespace Feng\BaiduMusic;

class BaiduMusic {
	/*
		Known error codes:
		22000: Success
		22232: Access denied (Non-Chinese IP)
		22012: Not found
	*/
	public function search( $keywords ) {
		$response = file_get_contents( "http://tingapi.ting.baidu.com/v1/restserver/ting?from=webapp_music&method=baidu.ting.search.catalogSug&format=json&callback=&query=" . urlencode( $keywords ) );
		$data = json_decode( $response, true );
		if ( $data['error_code'] == '22000' ) {
			return $data;
		} else {
			return false;
		}
	}
	public function getLinks( $songId ) {
		$response = file_get_contents( "http://ting.baidu.com/data/music/links?songIds=" . urlencode( $songId ) );
		$data = json_decode( $response, true );
		if ( $data['errorCode'] == '22000' || !count( $data['songList'] ) ) {
			return $data['data'];
		} else {
			return false;
		}
	}
}
