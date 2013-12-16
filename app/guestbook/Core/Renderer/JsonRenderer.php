<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:02
 */

namespace guestbook\Core\Renderer;


/**
 * Class JsonRenderer returns view data only (in json)
 *
 * @package guestbook\Core\Renderer
 */
class JsonRenderer extends AbstractRenderer
{

	/**
	 * @return string json representation of view data
	 */
	public function render()
	{
		return json_encode($this->data);
	}


} 