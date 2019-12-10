<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_business
 * @author     Megha B <meghabiranje@gmail.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */

// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\MVC\Controller\BaseController;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;

// Access check.
if (!Factory::getUser()->authorise('core.manage', 'com_business'))
{
	throw new Exception(Text::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Business', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('BusinessHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'business.php');

$controller = BaseController::getInstance('Business');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
