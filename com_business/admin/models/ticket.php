<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_business
 * @author     Manoj L <manoj_l@techjoomla.com>
 * @copyright  Copyright (C) 2017. All rights reserved.
 * @license    Manoj
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

use \Joomla\CMS\Table\Table;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Plugin\PluginHelper;
use \Joomla\CMS\Table\Date;

/**
 * Business model.
 *
 * @since  1.6
 */
class BusinessModelTicket extends \Joomla\CMS\MVC\Model\AdminModel
{
	/**
	 * @var      string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_BUSINESS';

	/**
	 * @var   	string  	Alias to manage history control
	 * @since   3.2
	 */
	public $typeAlias = 'com_business.ticket';

	/**
	 * @var null  Item data
	 * @since  1.6
	 */
	protected $item = null;

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 *
	 * @since    1.6
	 */
	public function getTable($type = 'Ticket', $prefix = 'BusinessTable', $config = array())
	{
		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      An optional array of data for the form to interogate.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  JForm  A JForm object on success, false on failure
	 *
	 * @since    1.6
     *
     * @throws
	 */
	public function getForm($data = array(), $loadData = true)
	{
            // Initialise variables.
            $app = Factory::getApplication();

            // Get the form.
            $form = $this->loadForm(
                    'com_business.ticket', 'ticket',
                    array('control' => 'jform',
                            'load_data' => $loadData
                    )
            );

            

            if (empty($form))
            {
                return false;
            }

            return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return   mixed  The data for the form.
	 *
	 * @since    1.6
     *
     * @throws
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = Factory::getApplication()->getUserState('com_business.edit.ticket.data', array());

		if (empty($data))
		{
			if ($this->item === null)
			{
				$this->item = $this->getItem();
			}

			$data = $this->item;
                        

			// Support for multiple or not foreign key field: education
			$array = array();

			foreach ((array) $data->priority as $value)
			{
				if (!is_array($value))
				{
					$array[] = $value;
				}
			}
			if(!empty($array)){

			$data->priority = $array;
			}
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function getItem($pk = null)
	{
            
            if ($item = parent::getItem($pk))
            {
                // Do any procesing on fields here if needed
            }

            return $item;
            
	}
	public function save($data)
	{
		
		$input = JFactory::getApplication()->input;
		JLoader::register('CategoriesHelper', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/categories.php');


		if($data['id']!=0)
		{
			$data['modified_date']=date('Y-m-d H:i:s');
			$data['modified_by']= JFactory::getUser()->id;

		}
		else
		{
			$data['created_date']=date('Y-m-d H:i:s');
		}

		
		// Validate the category id
		// validateCategoryId() returns 0 if the catid can't be found
		if ((int) $data['category'] > 0)
		{
			$data['category'] = CategoriesHelper::validateCategoryId($data['category'], 'com_tmt');
		}

		// Alter the greeting and alias for save as copy
		if ($input->get('task') == 'save2copy')
		{
			$origTable = clone $this->getTable();
			$origTable->load($input->getInt('id'));

			if ($data['name'] == $origTable->name)
			{
				//list($name, $alias) = $this->generateNewTitle($data['category'], $data['alias'], $data['name']);
				$data['name'] = $origTable->name;
				$data['alias'] = $origTable->alias;
			}
			else
			{
				if ($data['alias'] == $origTable->alias)
				{
					$data['alias'] = '';
				}
			}

			 // $date = JFactory::getDate();
    //  			if ($data['id'] == 0) 
    //  			{
    //      			$data['created_date'] = $date->toSql();
    //  			}
			// standard Joomla practice is to set the new record as unpublished
			//$data['published'] = 0;
		}
		
		return parent::save($data);
	}
	
	public function validate($form,$data,$group=null)
	{
		$data=parent::validate($form,$data,$group=null);
		if($data['title']==" " || $data['title']=="/t ")
		{
			JFactory::getApplication()->enqueueMessage(JText::_('COM_BUSINESS_FEILD_REQUIRED'));
			return false;
		}
		return $data;
	}

}
