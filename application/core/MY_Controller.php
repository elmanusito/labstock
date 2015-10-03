<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	// We'll use a constructor, as you can't directly call a function
	// from a property definition.
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function uri_autoformat_view($data, $url)
	{
		$split_result = preg_split('/\./', uri_string());
		$extension = sizeof($split_result) > 1 ? $split_result[1] : '';
		switch ($extension) {
			case 'js':
				//Show var $data in JSON format.
				$this->output->set_content_type('application/json')->set_output(json_encode($data));
				break;
			case 'xml':
				//creating object of SimpleXMLElement
				$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><result></result>");

				//function call to convert array to xml
				$this->_array_to_xml($data,$xml_user_info);

				//saving generated xml
				$xml_file = $xml_user_info->asXML();

				$this->output->set_content_type('application/xml')->set_output($xml_file);
				break;
			default:
				$this->load->view($url, $data);
				break;
		}
	}

	//function defination to convert array to xml
	private function _array_to_xml($array, &$xml_user_info) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				if(!is_numeric($key)){
					$subnode = $xml_user_info->addChild("$key");
					$this->_array_to_xml($value, $subnode);
				}else{
					$subnode = $xml_user_info->addChild("item_$key");
					$this->_array_to_xml($value, $subnode);
				}
			}else {
				$xml_user_info->addChild("$key",htmlspecialchars("$value"));
			}
		}
	}
}