<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<dl class="search-results<?php echo $this->pageclass_sfx; ?>">
<?php foreach($this->results as $result) : ?>
	<dt class="result-title">
		<?php echo $this->pagination->limitstart + $result->count.'. ';?>
		<?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
				<?php echo $this->escape($result->title);?>
			</a>
		<?php else:?>
			<?php echo $this->escape($result->title);?>
		<?php endif; ?>
	</dt>

	<?php if (($result->section) || ($this->params->get('show_date')) ) : ?>
		<dd class="result-info"><small>
			<?php if ($result->section) : ?>
				<span class="result-category<?php echo $this->pageclass_sfx; ?>">
					<?php echo JText::_('JCATEGORY').': '.$this->escape($result->section); ?>
				</span>
			<?php endif; ?>

			<?php if ($this->params->get('show_date') AND ($result->created) ) : ?>
				<span class="result-created<?php echo $this->pageclass_sfx; ?>">
					&nbsp;<i class="icon-calendar"></i>&nbsp;<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
				</span>
			<?php endif; ?>
		</small></dd>
	<?php endif; ?>
	
	<dd class="result-text">
		<?php echo $result->text; ?>
	</dd>
<?php endforeach; ?>
</dl>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
