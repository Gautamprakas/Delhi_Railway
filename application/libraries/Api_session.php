<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_session{

	private $folder_path;

	private $session_id;
	private $session_path;
	private $session_data;

	public function __construct( $params = [] ){
		$this->folder_path = APPPATH.'session';
		$this->session_id = $params["session_id"];
		$this->session_path = sprintf("%s/%s.json",$this->folder_path,$this->session_id);
	    if( @!file_exists($this->folder_path) ){
	    	@mkdir($this->folder_path, 0775, true);
	    }
	    
	}


	private function _read_data(){
	    if( $this->is_exist() && $content = file_get_contents($this->session_path) ){
	    	if( $this->session_data = json_decode($content,true) ){
	    		return true;
	    	}
	    	return false;
	    }
	    return false;
	}


	private function _write_data(){
	    if( @file_put_contents($this->session_path,json_encode($this->session_data)) !== FALSE ){
	    	return true;
	    }
	    exit("_write_data : api_session not working");
	}




	public function is_exist(){
		if( @file_exists($this->session_path) ){
			return true;
		}
		return false;
	}



	public function addKeyData($key='',$value=''){
		$this->_read_data();
		$this->session_data[$key] = $value;
		return $this->_write_data();
	}


	public function addKeysData($arr){
		$this->_read_data();
		foreach($arr as $key => $value){
			$this->session_data[$key] = $value;
		}
		return $this->_write_data();
	}


	public function getKeyData($key=''){
		if( $this->_read_data() ){
			return isset($this->session_data[$key])?$this->session_data[$key]:null;
		}
		return false;
	}


	public function getKeysData($key=''){
		if( $this->_read_data() ){
			return !empty($this->session_data)?$this->session_data:null;
		}
		return false;
	}


	public function getAllSessionJson(){
		if( $this->_read_data() ){
			return json_encode($this->session_data);
		}
		return false;
	}

	public function deleteKeyData($key=''){
		if( $this->_read_data() && $this->getKeyData($key)){
			unset($this->session_data[$key]);
			return $this->_write_data();
		}
		return false;
	}


	public function destory(){
		if( $this->is_exist() ){
			unlink($this->session_path);
			return true;
		}
		return false;
	}

}