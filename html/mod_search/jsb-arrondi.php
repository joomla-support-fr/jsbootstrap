<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$field_input = '<input name="searchword" id="mod-search-searchword" maxlength="'.$maxlength.'"  class=" search-query input-medium inputbox'.$moduleclass_sfx.'" type="text" size="'.$width.'" value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" onfocus="if (this.value==\''.$text.'\') this.value=\'\';" />';

if ($button) :
	if ($imagebutton) :
		$button = ' <input type="image" value="'.$button_text.'" class="button btn'.$moduleclass_sfx.'" src="'.$img.'" onclick="this.form.searchword.focus();"/>';
	else :
		$button = ' <input type="submit" value="'.$button_text.'" class="button btn btn-primary'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/>';
	endif;
endif;

$class = '';

switch ($button_pos) :
	case 'top' :
		$button = $button.'<br />';
		$output = $button.$field_input;
		break;

	case 'bottom' :
		$button = '<br />'.$button;
		$output = $field_input.$button;
		break;

	case 'right' :
		$class = ' input-append';
		$output = $field_input.$button;
		break;

	case 'left' :
	default :
		$class .= ' input-prepend';
		$output = $button.$field_input;
		break;
endswitch;

?>

<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-search">
	<div class="search-module <?php echo $class ?>">
		<?php echo $output; ?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</div>
</form>
