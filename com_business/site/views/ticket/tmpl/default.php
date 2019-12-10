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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_business');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_business'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<!-- <tr>
			<th><?php //echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_USER_ID'); ?></th>
			<td><?php //echo $this->item->user_id_name; ?></td>
		</tr> -->

		<tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_TITLE'); ?></th>
			<td><?php echo $this->item->title; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_ALIAS'); ?></th>
			<td><?php echo $this->item->alias; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_SHORT_DESCRIPTION'); ?></th>
			<td><?php echo $this->item->short_description; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_DESCRIPTION'); ?></th>
			<td><?php echo nl2br($this->item->description); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_IMAGE'); ?></th>
			<td><?php echo nl2br($this->item->image); ?></td>
        </tr>
        
        <tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_CATEGORY'); ?></th>
			<td><?php echo nl2br($this->item->category); ?></td>
        </tr>
        
        <tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_PRIORITY'); ?></th>
			<td><?php echo nl2br($this->item->priority); ?></td>
        </tr>
        
        <tr>
			<th><?php echo JText::_('COM_BUSINESS_FORM_LBL_TICKET_PRIVACY'); ?></th>
			<td><?php echo nl2br($this->item->privacy); ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_business&task=ticket.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_BUSINESS_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_business.ticket.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_BUSINESS_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_BUSINESS_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_BUSINESS_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_business&task=ticket.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_BUSINESS_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>