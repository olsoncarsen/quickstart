<?php 
	
defined('_JEXEC') or die;

class JabuilderViewRevisions extends JViewLegacy
{
	public function display($tpl = null)
	{
		$input = JFactory::getApplication()->input;
    	$id = $input->getInt('id');
		$this->items = $this->get('revisions');
		$this->pageId = $id;
		return parent::display($tpl);

	}
}

?>