<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * --------------------------------------------------------------------------------------
 * actualisé par lomart le 14/10/12 por JSBootstrap
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$app = JFactory::getApplication();

$canEdit = $params->get('access-edit');
$showRow1Left = ( $params->get('show_category') || $params->get('show_create_date') || $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_parent_category') || $params->get('show_hits') );
$showAuthor = ( $params->get('show_author') );
$showIcon = ( $params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit);
$showRow1Right = ($showAuthor || $showIcon);
$showRating = false;
$showInfos = ( $showRow1Left || $showRow1Right || $showRating );
?>

<!-- debut com_content\featured\default_item.php -->

<?php if ($this->item->state == 0) : ?>
	<div class="system-unpublished">
	<?php endif; ?>
	<?php if ($params->get('show_title')) : ?>
		<h2>
			<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
				<?php echo $this->escape($this->item->title); ?></a>
			<?php else : ?>
				<?php echo $this->escape($this->item->title); ?>
			<?php endif; ?>
		</h2>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if ($showInfos) : ?>
	<div class="article-info clearfix">
	<?php if ($showRow1Left) : ?>
		<span class="row1-left">
		<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
			<span class="item parent-category-name">
				<?php $title = $this->escape($this->item->parent_title);
					$title = ($title) ? $title : JText::_('JGLOBAL_UNCATEGORISED');
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
				<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
				<?php endif; ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		<?php if ($params->get('show_category')) : ?>
			<span class="item category-name">
				<?php 	$title = $this->escape($this->item->category_title);
						$title = ($title) ? $title : JText::_('JGLOBAL_UNCATEGORISED');
						$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
				<?php if ($params->get('link_category') and $this->item->catslug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
				<?php endif; ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		<?php if ($params->get('show_create_date')) : ?>
			<span class="item create">
			<i class="icon-calendar"></i>
			<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		<?php if ($params->get('show_modify_date')) : ?>
			<span class="item modified">
			<i class="icon-calendar"></i>
			<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		<?php if ($params->get('show_publish_date')) : ?>
			<span class="item published">
			<i class="icon-calendar"></i>
			<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		<?php if ($params->get('show_hits')) : ?>
			<span class="item hits">
			<i class="icon-eye-open"></i>
			<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		</span>
	<?php endif;  // $showRow1Left?>
	
	<?php if ($showRow1Right) : ?>
		<span class="row1-right pull-right">
		<?php if ($showAuthor) : ?>
			<span class="item createdby">
				<i class="icon-user"></i>
				<?php $author =  $this->item->author; ?>
				<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

					<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
						<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
						 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid), $author)); ?>

					<?php else :?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
					<?php endif; ?>
			</span>
			<span class="separator">|</span>
		<?php endif; ?>
		
		<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
			<span class="actions">
				<?php if ($params->get('show_print_icon')) : ?>
				<span class="print-icon">
					<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
				</span>
				<?php endif; ?>
				<?php if ($params->get('show_email_icon')) : ?>
				<span class="email-icon">
					<?php echo JHtml::_('icon.email', $this->item, $params); ?>
				</span>
				<?php endif; ?>

				<?php if ($canEdit) : ?>
				<span class="edit-icon">
					<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
				</span>
				<?php endif; ?>
			</span>
		<?php endif; ?>

		</span>
	<?php endif;  // $showRow1Right?>
	</div>
<?php endif;  // $showInfos?>


<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="img-intro-"<?php echo htmlspecialchars($imgfloat); ?>">
	<img
		<?php if ($images->image_intro_caption):
			echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php endif; ?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
		<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
						    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>
<!-- fin com_content\featured\default_item.php -->
