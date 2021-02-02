<?php

/**
 * summary
 */
class JabuilderModelRevisions extends JModelList
{
    /**
     * summary
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    public function getRevisions () {
    	$input = JFactory::getApplication()->input;
    	$id = $input->getInt('id');
    	$db = JFactory::getDbo();
    	$query = $db->getQuery(true);
    	$query->select ("*")
    		->from($db->quotename('#__jabuilder_revisions'))
    		->where('itemid = ' . $db->quote($id))
    		->order('id DESC');
		$db->setQuery($query);
		return $db->loadObjectList();
    }
    public function delete($cid){

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->delete('#__jabuilder_revisions')
			->where($db->quotename('id') . " IN (" . implode(',', $cid) . ")");
		$db->setQuery($query);
		return $db->execute();

    }
    public function deleteAll($page_id)
    {
    	$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->delete('#__jabuilder_revisions')
			->where($db->quotename('itemid') . " = " . $db->quote($page_id));
		$db->setQuery($query);
		return $db->execute();
    }
}


?>
