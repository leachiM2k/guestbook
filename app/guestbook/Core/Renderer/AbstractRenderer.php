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
	protected $appBasePath;
	protected $configuration;

	public function __construct(array $data = null)
	{
		if (isset($data))
		{
			$this->setData($data);
		}
	}

	public function setData(array $data)
	{
		$this->data = $data;
	}

	public function __get($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
	}

	function __isset($name)
	{
		if (isset($this->data[$name]))
		{
			return true;
		}
		elseif (isset($this->$name))
		{
			return true;
		}
		return false;
	}


	public function getUrl($routeName)
	{
		$route = $this->getConfiguration()->getRouter()->getRouteByName($routeName);
		if (isset($route))
		{
			return $this->getAppBasePath() . $route->getUrl();
		}
		return "";
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

	/**
	 * @param string $appBasePath
	 */
	public function setAppBasePath($appBasePath)
	{
		$this->appBasePath = $appBasePath;
	}

	/**
	 * @return string
	 */
	public function getAppBasePath()
	{
		return $this->appBasePath;
	}

	/**
	 * @param Configuration $configuration
	 */
	public function setConfiguration($configuration)
	{
		$this->configuration = $configuration;
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration()
	{
		return $this->configuration;
	}

	abstract public function render();
} 