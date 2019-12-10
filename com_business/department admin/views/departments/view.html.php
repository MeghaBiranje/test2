<?php

/**
 * @version    CVS: 1.0.4
 * @package    Com_Business
 * @author     Manoj L <manoj_l@techjoomla.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

use \Joomla\CMS\Language\Text;

/**
 * View class for a list of Business.
 *
 * @since  1.6
 */
class BusinessViewDepartments extends \Joomla\CMS\MVC\View\HtmlView
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		// if (count($errors = $this->get('Errors')))
		// {
		// 	throw new Exception(implode("\n", $errors));
		// }

		BusinessHelper::addSubmenu('departments');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = BusinessHelper::getActions();

		
		$title = JText::_('COM_BUSINESS_SUBMENU_DEPARTMENTS');
        if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
        }
		JToolBarHelper::title($title, 'stack');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/department';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('department.add', 'JTOOLBAR_NEW');

				if (isset($this->items[0]))
				{
					JToolbarHelper::custom('departments.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
				}
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('department.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('departments.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('departments.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'departments.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('departments.archive', 'JTOOLBAR_ARCHIVE');
			 }

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('departments.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('', 'departments.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::trash('departments.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_business');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_business&view=departments');
	}

	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`id`' => JText::_('JGRID_HEADING_ID'),
			'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
			'a.`state`' => JText::_('JSTATUS'),
			// 'a.`user_id`' => JText::_('COM_BUSINESS_DEPARTMENTS_USER_ID'),
			'a.`title`' => JText::_('COM_BUSINESS_DEPARTMENTS_NAME'),
			'a.`image`' => JText::_('COM_BUSINESS_DEPARTMENTS_SURNAME'),
			'a.`category`' => JText::_('COM_BUSINESS_DEPARTMENTS_EDUCATION'),
			'a.`priority`' => JText::_('COM_BUSINESS_DEPARTMENTS_HOBBIES'),
			'a.`privacy`' => JText::_('COM_BUSINESS_DEPARTMENTS_ADDRESS'),
		);
	}

    /**
     * Check if state is set
     *
     * @param   mixed  $state  State
     *
     * @return bool
     */
    public function getState($state)
    {
        return isset($this->state->{$state}) ? $this->state->{$state} : false;
    }
}
