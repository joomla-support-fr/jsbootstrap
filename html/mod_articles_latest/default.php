<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>


<?php if ($list[0]) { ?>
	<div class="last-update"><i class="icon-calendar"></i>&nbsp;
	<?php echo JHtml::_('date', $list[0]->modified, JText::_('DATE_FORMAT_LC2')); ?></div>
<?php } ?>

<ul class="latestnews nav nav-list">
<?php foreach ($list as $item) : ?>
	<li>
		<a href="<?php echo $item->link; ?>">
			<i class="icon-file"></i>
			<?php echo $item->title ?></a>
	</li>
<?php endforeach; ?>
</ul>
