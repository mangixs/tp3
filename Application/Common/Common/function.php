<?php
function p($arr){
    if ( is_bool($arr) ) {
        var_export($arr);
        exit;
    }else{
    	echo '<pre>';
    	print_r($arr);
    	echo '</pre>';
        exit;
    }
}
function json($arr){
	header('Content-Type:text/json;Charset:UTF-8');
	echo json_encode( $arr,JSON_UNESCAPED_UNICODE );
}