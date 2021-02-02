<?php
/**
T4 Overide
 */


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\String\StringHelper;

$user = Factory::getUser();

// Get the mime type class.
$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

$show_description = $this->params->get('show_description', 1);

if ($show_description)
{
	// Calculate number of characters to display around the result
	$term_length = StringHelper::strlen($this->query->input);
	$desc_length = $this->params->get('description_length', 255);
	$pad_length  = $term_length < $desc_length ? (int) floor(($desc_length - $term_length) / 2) : 0;

	// Make sure we highlight term both in introtext and fulltext
	if (!empty($this->result->summary) && !empty($this->result->body))
	{
		$full_description = FinderIndexerHelper::parse($this->result->summary . $this->result->body);
	}
	else
	{
		$full_description = $this->result->description;
	}

	// Find the position of the search term
	$pos = $term_length ? StringHelper::strpos(StringHelper::strtolower($full_description), StringHelper::strtolower($this->query->input)) : false;

	// Find a potential start point
	$start = ($pos && $pos > $pad_length) ? $pos - $pad_length : 0;

	// Find a space between $start and $pos, start right after it.
	$space = StringHelper::strpos($full_description, ' ', $start > 0 ? $start - 1 : 0);
	$start = ($space && $space < $pos) ? $space + 1 : $start;

	$description = HTMLHelper::_('string.truncate', StringHelper::substr($full_description, $start), $desc_length, true);
}
?>
<div class="result-item">
	<h4 class="result-title <?php echo $mime; ?>">
		<?php if ($this->result->route) : ?>
			<a href="<?php echo Route::_($this->result->route); ?>">
				<?php echo $this->result->title; ?>
			</a>
		<?php else : ?>
			<?php echo $this->result->title; ?>
		<?php endif; ?>
	</h4>

	<?php $taxonomies = $this->result->getTaxonomy(); ?>
	<?php if (count($taxonomies) && $this->params->get('show_taxonomy', 1)) : ?>
		<div class="result-taxonomy">
		<?php foreach ($taxonomies as $type => $taxonomy) : ?>
			<span class="badge badge-secondary"><?php echo $type . ': ' . implode(',', array_column($taxonomy, 'title')); ?></span>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if ($show_description && $description !== '') : ?>
		<div class="result-text">
			<?php echo $description; ?>
		</div>
	<?php endif; ?>
	<?php if ($this->result->start_date && $this->params->get('show_date', 1)) : ?>
		<div class="result-date">
			<?php echo HTMLHelper::_('date', $this->result->start_date, Text::_('DATE_FORMAT_LC3')); ?>
		</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_url', 1)) : ?>
		<div class="result-url">
			<?php echo $this->baseUrl, Route::_($this->result->cleanURL); ?>
		</div>
	<?php endif; ?>
</div>