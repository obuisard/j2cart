<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  J2Store.app_currencyupdater
 *
 * @copyright Copyright (C) 2014-24 Ramesh Elamathi / J2Store.org
 * @copyright Copyright (C) 2025 J2Commerce, LLC. All rights reserved.
 * @license https://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 or later
 * @website https://www.j2commerce.com
 */

defined('_JEXEC') or die;

require_once (JPATH_ADMINISTRATOR . '/components/com_j2store/library/appmodel.php');

class J2StoreModelAppCurrencyUpdaters extends J2StoreAppModel
{
    public $_element = 'app_currencyupdater';
}
