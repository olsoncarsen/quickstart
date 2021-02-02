<?php
/**
T4 Overide
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;

?>
<h3><?php echo JText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>
<ol class="nav nav-tabs nav-stacked">
<?php foreach ($this->link_items as &$item) : ?>
	<li>
		<a href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
			<?php echo $item->title; ?></a>
	</li>
<?php endforeach; ?>
</ol>
