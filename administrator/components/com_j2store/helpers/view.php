<?php
/**
 * @package     Joomla.Component
 * @subpackage  J2Store
 *
 * @copyright Copyright (C) 2014-24 Ramesh Elamathi / J2Store.org
 * @copyright Copyright (C) 2025 J2Commerce, LLC. All rights reserved.
 * @license https://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 or later
 * @website https://www.j2commerce.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class J2ViewHelper extends JObject
{
	public static $instance = null;
	protected $state;
	protected $template_path = '';
	protected $default_path = '';
	protected $default_template = null;

	public static function getInstance(array $config = array())
	{
		if (!self::$instance)
		{
			self::$instance = new self($config);
		}

		return self::$instance;
	}

	public function setTemplateOverridePath($path)
    {
        $this->template_path = $path;
	}

	public function getTemplateOverridePath()
    {
		return $this->template_path;
	}

	public function setDefaultViewPath($path)
    {
		$this->default_path = $path;
	}

	public function getDefaultViewPath()
    {
		return $this->default_path;
	}

	/**
	 * @param $layout the Path of the layout file
	 * @return string
	 */
	function getOutput($layout)
	{
		ob_start();
		$layout = $this->_getLayoutPath($layout);
		if(!empty($layout)) {
			include($layout);
			$html = ob_get_contents();
		}else {
			$html = '';
		}
		ob_end_clean();

		return $html;
	}

	/**
	 * Get the path to a layout file
	 *
	 * @param   string  $plugin The name of the plugin file
	 * @param   string  $group The plugin's group
	 * @param   string  $layout The name of the plugin layout file
	 * @return  string  The path to the plugin layout file
	 * @access protected
	 */
	function _getLayoutPath($layout = 'default')
	{
		$app = Factory::getApplication();

		// get the template and default paths for the layout
		$templatePath = $this->getTemplateOverridePath().'/'.$layout.'.php';
		$defaultPath = $this->getDefaultViewPath().'/'.$layout.'.php';
		// if the site template has a layout override, use it

		if (file_exists( $templatePath ))
		{
			return $templatePath;
		}
		elseif(file_exists( $defaultPath))
		{
			return $defaultPath;
		}else {
			return '';
		}
	}

	public function getTemplate($client = 'site')
    {
		if($client === 'admin') {
			$app_client = 1;
		}else{
			$app_client = 0;
		}

		if(!isset($this->default_template)) {
            $db = Factory::getContainer()->get('DatabaseDriver');
			$query = "SELECT template FROM #__template_styles WHERE client_id = ".$app_client." AND home=1";
			$db->setQuery( $query );
			$this->default_template = $db->loadResult();
		}
		return $this->default_template;
	}
}
