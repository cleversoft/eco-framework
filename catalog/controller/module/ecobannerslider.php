<?php

class ControllerModuleEcobannerslider extends Controller {
	public function index($setting) {

		$this->load->model('tool/image');
		$this->document->addStyle('catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/revslider.css');
		$this->document->addScript('catalog/view/theme/'.$this->config->get('config_template').'/js/revslider.js');
		$data = array();
		if (isset($setting['ecobannerslider_image'])) {
			$slider = array();
			foreach ($setting['ecobannerslider_image'] as $slide) {
 			$slider[] = array(
                            'title'=>html_entity_decode($slide['ecobannerslider_image_title'][$this->config->get('config_language_id')]['title']),
                            'link'=>$slide['link'],
                            'btn_name'=>html_entity_decode($slide['ecobannerslider_image_btn_name'][$this->config->get('config_language_id')]['btn_name']),
                            'short_title'=>html_entity_decode($slide['ecobannerslider_image_short_title'][$this->config->get('config_language_id')]['short_title']),
                            'image'=>$this->model_tool_image->resize($slide['image'], $setting['width'],$setting['height']),
                            'description'=>html_entity_decode($slide['ecobannerslider_image_description'][$this->config->get('config_language_id')]['description']));
			}
		}
		$data['class'] = isset($setting['class']) ? $setting['class'] : "" ;
		$data['enable_slider'] = $setting['slider'];
		$data['slider'] = $slider;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ecobannerslider.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/ecobannerslider.tpl', $data);
			} else {
				return $this->load->view('default/template/module/ecobannerslider.tpl', $data);
			}
		}
}
	