<?php
/**
 * @version    SVN: <svn_id>
 * @package    Business
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2017 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Tickets view class
 */
class BusinessViewTickets extends JViewLegacy
{
	// Overwriting JView display method
	public function display($tpl = null)
	{
		echo "<?xml version='1.0' encoding='UTF-8'?>
			 <article>
				<title>How to create a Joomla Component</title>
				<author>Megha</author>
			</article>";
	}
}
