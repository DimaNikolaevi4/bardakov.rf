<?php
/**
 * 
 * @package    System - IWS.BY Yandex Metrika
 * @subpackage Modules
 * @license    GNU GPL v3 or later, see LICENSE.txt
 * @link       https://iws.by/en/product/yandex-metrica-for-joomla/
 * 
 */

 // No direct access
defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\FormField;
class JFormFieldiwsbyextensions extends FormField
{
	protected $type = 'iwsbyextensions';
	protected $hiddenLabel = true;
	protected $hiddenDescription = true;

	public function getLabel() {
		if (empty($this->element['label']) && empty($this->element['description'])) {
            return '';
        }
		
		$html = array();

		$html[] = "<div>";

		$text = $this->element['label'] ? (string) $this->element['label'] : (string) $this->element['name'];
		$text = $this->translateLabel ? Text::_($text) : $text;

		$html[] = $text;
		
		$html[] = "</div>";
		
		$html[] = '<div class="iwsbywhatsappbutton_content">';
			$html[] = '<div style="display: flex;flex-wrap: wrap;">';
			
			if(Factory::getApplication()->getLanguage()->getTag() == "ru-RU"){
				$xml = simplexml_load_file('https://iws.by/yJoomlaYmlRU.xml');
			}else{
				$xml = simplexml_load_file('https://iws.by/yJoomlaYmlEN.xml');
			}
			if($xml){
				foreach($xml->offer as $element){
				$html[] = '<div style="flex: 1 0 21%;margin: 15px;margin-bottom: 30px;text-align: center;margin-bottom: 35px;">';
					$html[] = '<div style="background: white;border-radius: 5px;box-shadow: 0 0 10px rgba(0,0,0,0.5);height: 100%;padding: 15px 15px 5px 15px;">';
						$html[] = '<div style="margin-bottom: 10px;">';
							$html[] = '<a href="'.$element->url.'" target="_blank">';
								$html[] = '<img src="'.$element->picture.'" style="width:70%;">';
							$html[] = '</a>';
						$html[] = '</div>';
						$html[] = '<div class="iwsbywhatsappbutton_row_item_box_title" style="margin-bottom:10px;">';
							$html[] = '<a href="'.$element->url.'" target="_blank" style="color: black;text-decoration: none;font-size: 20px;text-transform: uppercase;font-weight: 600;line-height: 1.2;display: block;">';
								$html[] = $element->name;
							$html[] = '</a>';
						$html[] = '</div>';
						$html[] = '<div class="iwsbywhatsappbutton_row_item_box_more">';
							$html[] = '<a href="'.$element->url.'" target="_blank" style="background: #2271b1;border-color: #2271b1;color: #fff;text-decoration: none;text-shadow: none;display: inline-block;text-decoration: none;font-size: 13px;line-height: 2.15384615;min-height: 30px;margin: 0;padding: 0 10px;cursor: pointer;border-width: 1px;border-style: solid;-webkit-appearance: none;border-radius: 3px;white-space: nowrap;box-sizing: border-box;">';
								$html[] = '<b>'.Text::_("PLG_IWSBY_YAMETRIKA_IWSBY_READ_MORE").'</b>';
							$html[] = '</a>';
						$html[] = '</div>';
					$html[] = '</div>';
				$html[] = '</div>';
				}
			}
			$html[] = '</div>';
		$html[] = '</div>';

		return '</div><div>'.implode('', $html);
	}

	public function getInput() {
		return ' ';
	}
}
