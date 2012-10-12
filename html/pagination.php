<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * -------------------------------------------------------------
 * modif lomart pour JSB le 6/10/12
 * utilisation des btn-group / btn-primary de bootstrap
 */

defined('JPATH_PLATFORM') or die;

/**
 * Pagination Class.  Provides a common interface for content pagination for the
 * Joomla! Platform.
 *
 * @package     Joomla.Platform
 * @subpackage  HTML
 * @since       11.1
 */
function pagination_list_render($list)
{
	// Reverse output rendering for right-to-left display.
	$app = JFactory::getApplication();
	$html = '<div class="btn-toolbar"> <div class="btn-group">';
	$html .= $list['start']['data'];
	$html .= $list['previous']['data'];
	foreach ($list['pages'] as $page)
	{
			$html .= $page['data'];
	}
	$html .= $list['next']['data'];
	$html .= $list['end']['data'];
	$html .= '</div></div>';

	return $html;
}
/**
 * Method to create an active pagination link to the item
 *
 * @param   JPaginationObject  &$item  The object with which to make an active link.
 *
 * @return   string  HTML link
 *
 * @since    11.1
 */
function pagination_item_active(&$item)
{
	$app = JFactory::getApplication();
	if ($app->isAdmin())
	{
		if ($item->base > 0)
		{
			return "<a class=\"btn btn-primary\" title=\"" . $item->text . "\" onclick=\"document.adminForm." . $this->prefix . "limitstart.value=" . $item->base
				. "; Joomla.submitform();return false;\">" . $item->text . "</a>";
		}
		else
		{
			return "<a class=\"btn btn-primary\" title=\"" . $item->text . "\" onclick=\"document.adminForm." . $this->prefix
				. "limitstart.value=0; Joomla.submitform();return false;\">" . $item->text . "</a>";
		}
	}
	else
	{
		return "<a class=\"btn btn-primary\" title=\"" . $item->text . "\" href=\"" . $item->link . "\">" . $item->text . "</a>";
	}
}
/**
 * Method to create an inactive pagination string
 *
 * @param   object  &$item  The item to be processed
 *
 * @return  string
 *
 * @since   11.1
 */
function pagination_item_inactive(&$item)
{
	$app = JFactory::getApplication();
	if ($app->isAdmin())
	{
		return "<a class=\"btn  btn-primary\" href=\"#\">" . $item->text . "</a>";
	}
	else
	{
		return "<a class=\"btn  btn-primary disabled\" href=\"#\">" . $item->text . "</a>";
	}
}