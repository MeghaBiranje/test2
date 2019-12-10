<?php
/**
 * @version    CVS: 1.0.4
 * @package    Com_business
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


HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');
HTMLHelper::_('behavior.tooltip');
HTMLHelper::_('behavior.formvalidation');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('behavior.keepalive');

// Import CSS
$document = Factory::getDocument();
$document->addStyleSheet(Uri::root() . 'media/com_business/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	});

	Joomla.submitbutton = function (task) {
		if (task == 'department.cancel') {
			Joomla.submitform(task, document.getElementById('department-form'));
		}
		else {
			
			if (task != 'department.cancel' && document.formvalidator.isValid(document.id('department-form'))) {
				
				Joomla.submitform(task, document.getElementById('department-form'));
			}
			else {
				alert('<?php echo $this->escape(Text::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_business&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="department-form" class="form-validate form-horizontal">

	
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
	
	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'department')); ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'department', JText::_('COM_BUSINESS_TAB_DEPARTMENT', true)); ?>
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo JText::_('COM_BUSINESS_FIELDSET_DEPARTMENT'); ?></legend>
				<?php echo $this->form->renderField('created_by'); ?>
				<!-- <?php //echo $this->form->renderField('user_id'); ?> -->
				<?php echo $this->form->renderField('title'); ?>
				<?php echo $this->form->renderField('alias'); ?>
				<?php echo $this->form->renderField('short_description'); ?>
				<?php echo $this->form->renderField('description'); ?>
				<?php echo $this->form->renderField('image'); ?>
                <?php echo $this->form->renderField('category'); ?>
                <?php echo $this->form->renderField('priority'); ?>
                <?php echo $this->form->renderField('privacy'); ?>
				<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
				<?php endif; ?>
			</fieldset>
		</div>
	</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	
	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	<input type="hidden" name="task" value=""/>
	<?php echo JHtml::_('form.token'); ?>

</form>
