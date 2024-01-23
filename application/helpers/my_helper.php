<?php

function mtime($str_format=null,$timestap=null){
	if( !empty($str_format) && !empty($timestap) ){
		return date($str_format,$timestap);
	}else if( empty($str_format) && !empty($timestap) ){
		return date("Y-m-d H:i:s",$timestap);
	}else if( !empty($str_format) && empty($timestap) ){
		return date($str_format);
	}else{
		return date("Y-m-d H:i:s");
	}
}