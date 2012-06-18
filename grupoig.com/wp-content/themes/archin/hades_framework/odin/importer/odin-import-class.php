<?php
class odin_wp_import extends WP_Import
{
	var $preStringOption; 
	var $results;
	var $getOptions;
	var $saveOptions;
	var $termNames;
	
	function saveOptions()
	{	
		//here goes option saving in future versions
	}
	
	
	function getValues()
	{
		foreach ($this->getOptions as $key => $option)
		{
			foreach ($option as $name)
			{
				switch($key)
				{
					case 'page': 
						$the_page = get_page_by_title($name);
						$results[$key][$name] = $the_page->ID;
					break;
					
					default:
						$the_category = get_term_by('slug', $name, $key);
						$results[$key][$name] = $the_category->term_id;
					break;
				}
			}
		}

	return $results;
	}
	
}