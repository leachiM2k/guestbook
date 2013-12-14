<?php
/**
 * User: Michael
 * Date: 14.12.13
 * Time: 12:55
 */

namespace guestbook\Core\Renderer;

abstract class AbstractRenderer
{
	protected $data = array();

	protected $templateBasePath = ".";
	protected $templateFileName;

	public function setData($data)
	{
		$this->data = $data;
	}

	public function __get($name)
	{
		if(isset($this->data[$name]))
		{
			return $this->data[$name];
		}
	}

	public function setTemplateBasePath($templateBasePath)
	{
		$this->templateBasePath = $templateBasePath;
	}

	/**
	 * @param string $templateFileName
	 */
	public function setTemplateFileName($templateFileName)
	{
		$this->templateFileName = $templateFileName;
	}

	abstract public function render();
} 