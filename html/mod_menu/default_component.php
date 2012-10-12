<?php
/**
 * @version		$Id: default_component.php 21322 2011-05-11 01:10:29Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * ------------------------------------------
 * JSB/LOMART 8/10/12 :  prise en charge dropdown sur parent
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.

if ($item->parent) {
	$class = 'class="dropdown-toggle'.trim(' '.$item->anchor_css).'" ';
	$data_toggle = $item->parent ? 'data-toggle="dropdown" ' : '';
	//$caret = $item->parent ? '<b class="caret"></b> ' : '';
	$caret = '';
}
else {
	$class = $item->anchor_css ? 'class="'.$item->anchor_css.'" ' : '';
	$data_toggle = ''; 
	$caret='';
}

$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
elseif (($item->deeper) && ($nav_dropdown)) { 
	
	$linktype = $item->title. '<b class="caret"></b>' ;
	if ($item->level < 2) {
	$class = 'class="'.$item->anchor_css.' dropdown-toggle" data-toggle="dropdown" ';
	$item->flink = '#';
	}
	else {
	$linktype = $item->title;
	}
}
elseif (($item->deeper) && (!$nav_stacked) && (!$nav_list) && ($nav_flyout)) {
	$linktype = $item->title. '<b class="caret"></b>' ;
}
else { 
	$linktype = $item->title;
}
switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?><?php echo $data_toggle; ?>href="<?php echo $item->flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $caret; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?><?php echo $data_toggle; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $caret; ?></a><?php
		break;
	case 2:
	// window.open
?><a <?php echo $class; ?><?php echo $data_toggle; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $caret; ?></a>
<?php
		break;
endswitch;
