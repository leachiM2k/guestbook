<?php
/**
 * User: Michael
 * Date: 14.12.13
 * Time: 12:55
 */

namespace guestbook\Core\Renderer;

use guestbook\Core\Configuration;

/**
 * Class AbstractRenderer provides basic methods for all renderers and defines some interfaces
 *
 * @package guestbook\Core\Renderer
 */
abstract class AbstractRenderer
{
	/**
	 * @var array Holder for view data
	 */
	protected $data = array();

	/**
	 * @var string Path for templates
	 */
	protected $templateBasePath = ".";
	/**
	 * @var string template file name. mostly set by resource
	 */
	protected $templateFileName;
	/**
	 * @var string base URL of application. needed to build urls.
	 */
	protected $appBasePath;
	/**
	 * @var Configuration
	 */
	protected $configuration;

	/**
	 * @param array $data view data
	 */
	public function __construct(array $data = null)
	{
		if (isset($data))
		{
			$this->setData($data);
		}
	}

	/**
	 * setter for view data
	 *
	 * @param array $data view data
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Magical getter used by views to retrieve stored data
	 *
	 * @param $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
	}

	/**
	 * Magical isset used by views to check for stored data
	 *
	 * @param $name
	 * @return bool
	 */
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


	/**
	 * gets absolute url for known route
	 *
	 * @param $routeName registered route name
	 * @return string absolute URL or empty string
	 */
	public function getUrl($routeName)
	{
		$route = $this->getConfiguration()->getRouter()->getRouteByName($routeName);
		if (isset($route))
		{
			return $this->getAppBasePath() . $route->getUrl();
		}
		return "";
	}

	/**
	 * setter for template base path
	 *
	 * @param $templateBasePath
	 */
	public function setTemplateBasePath($templateBasePath)
	{
		$this->templateBasePath = $templateBasePath;
	}

	/**
	 * setter for template file name. we'll look for it in templatePath
	 *
	 * @param string $templateFileName
	 */
	public function setTemplateFileName($templateFileName)
	{
		$this->templateFileName = $templateFileName;
	}

	/**
	 * setter for applicaton base path
	 *
	 * @param string $appBasePath
	 */
	public function setAppBasePath($appBasePath)
	{
		$this->appBasePath = $appBasePath;
	}

	/**
	 * getter for applicaton base path
	 *
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

	/**
	 * This method returns rendered string based on used renderer
	 *
	 * @return string
	 */
	abstract public function render();
} 