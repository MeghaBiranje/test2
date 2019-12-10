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

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.tooltip');
HTMLHelper::_('behavior.formvalidation');
HTMLHelper::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = Factory::getLanguage();
$lang->load('com_business', JPATH_SITE);
$doc = Factory::getDocument();
$doc->addScript(Uri::base() . '/media/com_business/js/form.js');

$user    = Factory::getUser();
$canEdit = BusinessHelpersBusiness::canUserEdit($this->item, $user);


?>

<div class="department-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
			<?php throw new Exception(Text::_('COM_BUSINESS_ERROR_MESSAGE_NOT_AUTHORISED'), 403); ?>
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1><?php echo Text::sprintf('COM_BUSINESS_EDIT_ITEM_TITLE', $this->item->id); ?></h1>
		<?php else: ?>
			<h1><?php echo Text::_('COM_BUSINESS_ADD_ITEM_TITLE'); ?></h1>
		<?php endif; ?>

		<form id="form-department"
			  action="<?php echo Route::_('index.php?option=com_business&task=department.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />

	<!-- <input type="hidden" name="jform[state]" value="<?php //echo $this->item->state; ?>" /> -->

	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->getInput('created_by'); ?>
	<?php echo $this->form->renderField('user_id'); ?>
	<?php echo $this->form->renderField('state'); ?>
	
	<?php echo $this->form->renderField('title'); ?>

	<?php echo $this->form->renderField('alias'); ?>

	<?php echo $this->form->renderField('short_description'); ?>

	<?php echo $this->form->renderField('description'); ?>

    <?php echo $this->form->renderField('image'); ?>
    
    <?php echo $this->form->renderField('category'); ?>
    
    <?php echo $this->form->renderField('priority'); ?>

    <?php echo $this->form->renderField('privacy'); ?>

			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<?php echo Text::_('JSUBMIT'); ?>
						</button>
					<?php endif; ?>
					<a class="btn"
					   href="<?php echo Route::_('index.php?option=com_business&task=departmentform.cancel'); ?>"
					   title="<?php echo Text::_('JCANCEL'); ?>">
						<?php echo Text::_('JCANCEL'); ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_business"/>
			<input type="hidden" name="task"
				   value="departmentform.save"/>
			<?php echo HTMLHelper::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
