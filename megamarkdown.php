<?php
define("ARRAY_PATH_ERROR", FALSE);
class megamarkdown {
	public function Version(){ return '0.1'; }
	/*private*/ var $settings = array();
	/*private*/ var $settings_file = NULL;
	public function megamarkdown(){
		$this->load_settings();
	}
	public function load_settings($input=NULL, $type="file"){
		/*fix*/ $file = FALSE;
		if($type == "file"){ $file = $input; }
		switch(strtolower($type)){
			case 'file':
				/*fix*/ if($file === NULL){ $file = ($this->settings_file !== NULL ? $this->settings_file : dirname(__FILE__).DIRECTORY_SEPARATOR.'megamarkdown.json'); }
		                if($file && file_exists($file)){
		                        $input = file_get_contents($file);
		                        $this->settings_file = $file;
		                        return $this->load_settings($input, "json");
		                } else { return FALSE; }
				break;
			case 'json':
				//*debug*/$this->settings = $input;
				$this->settings = json_decode($input, TRUE);
				return $this->settings;
				break;
			default: return FALSE;
		}
		return TRUE;
	}
	public function default_settings(){
		$settings = (array) json_decode('{"version": {"php": "'.self::Version().'", "ckeditor": {"release": "", "plug-in": "'.self::array_value_by_path(json_decode(file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'about.json'), TRUE), "version").'"}} }', TRUE);
		$settings = array_merge($settings, $this->load_settings() );
		return $settings;
		//*debug*/return $this->settings;
	}
	private function array_value_by_path($array, $path=NULL, $doBoolianize=FALSE, $alsoNULL=FALSE){
		/*fix*/ if(!is_array($array)){ return ARRAY_PATH_ERROR; }
		if($path === NULL){ return $array; }
		preg_match("#^([^/]+)(/(.*))?$#i", $path, $buffer);
		if(isset($array[$buffer[1]])){
			if(isset($buffer[3])){
				return self::auto_boolianize(self::array_value_by_path($array[$buffer[1]], $buffer[3]), $alsoNULL, $doBoolianize);
			} else {
				return self::auto_boolianize($array[$buffer[1]], $alsoNULL, $doBoolianize);
			}
		} else { return ARRAY_PATH_ERROR; }
	}
	private function auto_boolianize($value, $alsoNULL=FALSE, $doBoolianize=TRUE){
		if(is_string($value) && $doBoolianize){
			if( strtolower($value) === 'true'){ return TRUE; }
			elseif( strtolower($value) === 'false'){ return FALSE; }
			elseif($alsoNULL && strtolower($value) === 'null'){ return NULL; }
		}
		return $value;
	}
	public function get_setting($path){
		if(!(self::array_value_by_path($this->settings, $path) === ARRAY_PATH_ERROR)){ return self::array_value_by_path($this->settings, $path); }
		elseif(!(self::array_value_by_path(self::default_settings(), $path) === ARRAY_PATH_ERROR)){ return self::array_value_by_path(self::default_settings(), $path); }
		else{ return ARRAY_PATH_ERROR; }
	}
}
function megamarkdown2html($mmd){
	return $html;
}
//function html2megamarkdown($html){ return $mmd; }

//if($_GET["action"] == "debug-megamarkdown"){
	$mmd = new megamarkdown();
	//$mmd->load_settings('{"singlespaced": "true"}', "json");
	print '<pre>';
	print_r($mmd);
	//foreach($mmd->settings as $name=>$value){ print "$[".$name."] = ".print_r($mmd->get_setting($name), TRUE)."\n"; }
	foreach(array('headings/style','headings/underlined','tasks/indent-spaces','version','tables/style/0') as $path){ print "%{".$path."} = ".print_r($mmd->get_setting($path), TRUE)."\n"; }
	print '</pre>';
//}
?>
