<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * -------------------------------------------------------------------------------------
 * surcharge Protostar adapté par Lomart (5/10/12)
 * - position et présentation icone print, email, edit (pas de drop down)
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

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

$urls    = json_decode($this->item->urls);
$user    = JFactory::getUser();

JHtml::_('behavior.caption');

?>

<div class="item-page<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	echo $this->item->pagination;
}
?>
	<!-- titre article -->
	<?php if (($params->get('show_title')) || ($params->get('show_author'))) : ?>
	<div class="page-header">
		<h2>
			<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
			<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
			<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
			<?php endif; ?>
		</h2>
	</div>
	<?php endif; ?>
	<!-- table des matières -->
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>

<?php if ($showInfos) : ?>
	<div class="article-info clearfix">
	<!-- vote dans une colonne à gauche -->
	<div class="rating">
		<?php echo $this->item->event->beforeDisplayContent; ?>
	</div>
	<!-- -->
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
	
	<?php  if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>

	<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position == '0')) OR  ($params->get('urls_position') == '0' AND empty($urls->urls_position)))
		OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>
	<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
	<?php if ($images->image_fulltext_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/> </div>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
	echo $this->item->pagination;
endif;
?>
	<?php echo $this->item->text; ?>
	<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position == '1')) OR ($params->get('urls_position') == '1'))): ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php //optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
	<p class="readmore"> <a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
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
		endif; ?>
		</a> </p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php echo $this->item->event->afterDisplayContent; ?> </div>
