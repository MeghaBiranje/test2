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
HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');
HTMLHelper::_('formbehavior.chosen', 'select');

$user       = Factory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_business') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'employeeform.xml');
$canEdit    = $user->authorise('core.edit', 'com_business') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'employeeform.xml');
$canCheckin = $user->authorise('core.manage', 'com_business');
$canChange  = $user->authorise('core.edit.state', 'com_business');
$canDelete  = $user->authorise('core.delete', 'com_business');

// Import CSS
$document = Factory::getDocument();
$document->addStyleSheet(Uri::root() . 'media/com_business/css/list.css');
?>

<form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post"
      name="adminForm" id="adminForm">

	<?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
<div class="table-responsive">
	<table class="table table-striped" id="employeeList">
		<thead>
		    <tr>
                <?php if (isset($this->items[0]->state)): ?>
                    <th width="5%">
                        <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'state', $listDirn, $listOrder); ?>
                    </th>
                <?php endif; ?>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_ID', 'id', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_TITLE', 'title', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_SHORT_DESCRIPTION', 'short_description', $listDirn, $listOrder); ?>
				</th>
				<!-- <th class=''>
				<?php //echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_DESCRIPTION', 'a.description', $listDirn, $listOrder); ?>
				</th> -->
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_IMAGE', 'image', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_PRIORITY', 'priority', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_BUSINESS_EMPLOYEES_PRIVACY', 'privacy', $listDirn, $listOrder); ?>
				</th>


				<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				        <?php echo JText::_('COM_BUSINESS_EMPLOYEES_ACTIONS'); ?>
				    </th>
				<?php endif; ?>

		    </tr>
		</thead>
		<tfoot>
				<tr>
					<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 5; ?>">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
			<?php $canEdit = $user->authorise('core.edit', 'com_business'); ?>

							<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_business')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

			<tr class="row<?php echo $i % 2; ?>">
                <?php if (isset($this->items[0]->state)) : ?>
					<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
					<td class="center">
	                    <a class="btn btn-micro <?php echo $class; ?>" href="<?php echo ($canChange) ? JRoute::_('index.php?option=com_business&task=employee.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
	                    <?php if ($item->state == 1): ?>
		                    <i class="icon-publish"></i>
	                    <?php else: ?>
		                    <i class="icon-unpublish"></i>
	                    <?php endif; ?>
	                    </a>
                    </td>
				<?php endif; ?>

					<td>
                        <?php echo $item->id; ?>
				    </td>
				    <td>
					<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'employees.', $canCheckin); ?>
				<?php endif; ?>
				<a href="<?php echo JRoute::_('index.php?option=com_business&view=employee&id='.(int) $item->id); ?>">
				<?php echo $this->escape($item->title); ?></a>
									<span class="small break-word">
										<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS' , $this->escape($item->alias)); ?>
									</span>
									<div class="small">
										<?php echo JText::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
									</div>
				    </td>
				   
				    <td>
                       <?php echo $item->short_description; ?>
				    </td>
				    <!-- <td>
                       <?php //echo $item->description; ?>
				    </td> -->
				    <td>
						<?php 
							$src = JURI::root() . ($item->image ? : '' );
							$html = '<p class="hasTooltip" style="disply: inline-block" data-html="true" data-toggle="tooltip" data-placement="right" title="<img width=\'100px\' height=\'100px\' src=\'%s\'>">%s</p>';
							echo sprintf($html, $src,$item->title."Image"); 
						?>
					</td>
                   
                    <td>
                        <?php echo $item->priority; ?>
                    </td>
                    <td>
                        <?php echo $item->privacy; ?>
				    </td>
                <?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_business&task=employeeform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_business&task=employeeform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
	<?php if ($canCreate) : ?>
		<a href="<?php echo Route::_('index.php?option=com_business&task=employeeform.edit&id=0', false, 0); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo Text::_('COM_BUSINESS_ADD_ITEM'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<?php if($canDelete) : ?>
<script type="text/javascript">

	jQuery(document).ready(function () {
		jQuery('.delete-button').click(deleteItem);
	});

	function deleteItem() {

		if (!confirm("<?php echo Text::_('COM_BUSINESS_DELETE_MESSAGE'); ?>")) {
			return false;
		}
	}
</script>
<?php endif; ?>
