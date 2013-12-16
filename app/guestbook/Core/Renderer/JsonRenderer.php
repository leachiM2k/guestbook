<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:02
 */

namespace guestbook\Core\Renderer;


class JsonRenderer extends AbstractRenderer
{

	public function render()
	{
		return json_encode($this->data);
	}


} 