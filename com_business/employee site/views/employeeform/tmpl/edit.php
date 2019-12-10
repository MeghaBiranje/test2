<?php
/**
 * @version    SVN: <svn_id>
 * @package    Tjfields
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2015 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'employeeform.cancel')
		{
			Joomla.submitform(task, document.getElementById('employee-form'));
		}
		else
		{
			if (task != 'employeeform.cancel' && document.formvalidator.isValid(document.id('employee-form')))
			{
				Joomla.submitform(task, document.getElementById('employee-form'));
			}
			else
			{
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<div class="">
	<form
		action="<?php echo JRoute::_('index.php?option=com_business&view=employee&layout=edit&id=' . (int) $this->item->id, false);?>"
		method="post" enctype="multipart/form-data" name="employee-form"
		id="employee-form" class="form-validate">

		<div class="form-horizontal">
			<div class="row-fluid">
				<div class="span12 form-horizontal">
					<fieldset class="adminform">

                        <!-- <?php //echo $this->form->renderField('user_id'); ?> -->

                        <?php echo $this->form->renderField('title'); ?>

                        <?php echo $this->form->renderField('alias'); ?>

                        <?php echo $this->form->renderField('short_description'); ?>

                        <?php echo $this->form->renderField('description'); ?>

                        <?php echo $this->form->renderField('image'); ?>

                        <?php echo $this->form->renderField('category'); ?>

                        <?php echo $this->form->renderField('priority'); ?>

                        <?php echo $this->form->renderField('privacy'); ?>
					</fieldset>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a type="button" class="btn btn-primary validate" onclick="Joomla.submitbutton('employeeform.save');">
					<?php echo JText::_('JSUBMIT'); ?>
				</a>
					<a class="btn"
						href="<?php echo JRoute::_('index.php?option=com_business&view=employees'); ?>"
						title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
				</a> <input type="hidden" name="option" value="com_business" />
				<input
						type="hidden" name="controller" value="employeeform" />
									<input type="hidden" name="view" value="employeeform" />

				</div>
			</div>
			<input type="hidden" name="jform[user_id]" value="<?php echo JFactory::getUser()->id; ?>"/>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
