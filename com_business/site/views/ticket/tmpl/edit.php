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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'ticket.cancel')
		{
			Joomla.submitform(task, document.getElementById('ticket-form'));
		}
		else
		{
			if (task != 'ticket.cancel' && document.formvalidator.isValid(document.id('ticket-form')))
			{
				Joomla.submitform(task, document.getElementById('ticket-form'));
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
		action="<?php echo JRoute::_('index.php?option=com_business&view=ticket&layout=edit&id=' . (int) $this->item->id, false);?>"
		method="post" enctype="multipart/form-data" name="adminForm" id="ticket-form" class="form-validate">

		<div class="form-horizontal">
			<div class="row-fluid">
				<div class="span12 form-horizontal">
					<fieldset class="adminform">

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('id'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('id'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('user_id'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('user_id'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('fname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('fname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('mname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('mname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('lname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('lname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('class'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('class'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('mobile'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('mobile'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('address'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('address'); ?>
							</div>
						</div>
					</fieldset>
				</div>
			</div>

			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
