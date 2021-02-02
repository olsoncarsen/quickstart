<?php
JHtml::_('behavior.core');
JHtml::_('behavior.formvalidator');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
$items = $this->items;

// Search tools bar
// echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
?>
<div class="container-popup">
    <div class="toolbar btn-group pull-right">
        <button class="btn btn-small button-trash" onclick="if (document.adminForm.boxchecked.value == 0) { alert('Please first make a selection from the list.');console.log(Joomla); } else { Joomla.submitbutton('revisions.delRevision'); }">Delete</button>
        <button class="btn btn-small button-trash" onclick="if(confirm('Are you sure?') == true){ Joomla.submitbutton('revisions.removeAllRev'); }">Delete All</button>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-condensed">
    <form action="<?php echo JRoute::_('index.php?option=com_jabuilder&view=revisions&id='.$this->pageId.'&tmpl=component'); ?>" method="post" name="adminForm" id="adminForm">
        
    	<div class="revision">
        	<div class="t4b-revision-container">
		        <?php if (empty($this->items)) : ?>
		        <div class="alert alert-no-items">
		            <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		        </div>
		        <?php else : ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="1%" class="center">
                                <?php echo JHtml::_('grid.checkall'); ?>
                            </th>
                            <th class="center">Revision Id</th>
                            <th class="center">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $i => $item):?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center">
                                <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                            </td>
                            <td class="center">
                                <?php echo $item->id;?>
                            </td>
                            <td class="center">
                                <?php echo $item->created;?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif;?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>