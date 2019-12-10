<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_business
 * @author     Megha B <meghabiranje@gmail.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */

defined('_JEXEC') or die;

use \Joomla\CMS\Factory;
use \Joomla\CMS\MVC\Controller\BaseController;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Business', JPATH_COMPONENT);
JLoader::register('BusinessController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = BaseController::getInstance('Business');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
