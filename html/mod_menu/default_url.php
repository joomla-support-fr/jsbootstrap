<?php
/**
 * @version		$Id: default_url.php 22411 2011-11-28 21:03:49Z github_bot $
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * ------------------------------------------
 * JSB/LOMART 8/10/12 :  prise en charge dropdown sur parent
 */

// No direct access.
defined('_JEXEC') or die;

// var_dump($item);

// Note. It is important to remove spaces between elements.

if ($item->parent) {
	$class = 'class="dropdown-toggle'.trim(' '.$item->anchor_css).'" ';
	$data_toggle = $item->parent ? 'data-toggle="dropdown" ' : '';
	$caret = $item->parent ? '<b class="caret"></b> ' : '';
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
else { $linktype = $item->title;
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
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?><?php echo $data_toggle; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $caret; ?></a><?php
		break;
endswitch;
