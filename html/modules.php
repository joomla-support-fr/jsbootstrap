<?php


defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * three arguments.
 */

/*
 * ajoute la classe jsb-userbottom uniquement au premier parent
 * alors qu'un suffixe l'ajoute à toutes
*/ 
?>

<?php 
function modChrome_JSBusertop($module, &$params, &$attribs)
{
	if (!empty ($module->content)) { ?>
		<div class="jsb-usertop moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
			<?php if ($module->showtitle != 0) : ?>
			<h3><span><?php echo $module->title; ?></span></h3>
			<?php endif; ?>
		<?php echo $module->content; ?></div>
<?php };
} ?>
 
<?php 
function modChrome_JSBuserbottom($module, &$params, &$attribs)
{
	if (!empty ($module->content)) { ?>
		<div class="jsb-userbottom moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
			<?php if ($module->showtitle != 0) : ?>
			<h3><span><?php echo $module->title; ?></span></h3>
			<?php endif; ?>
		<?php echo $module->content; ?></div>
<?php };
} ?>
 
<?php  
/*
 * Default Module Chrome that has sematic markup and has best SEO support
 */
function modChrome_JAxhtml($module, &$params, &$attribs)
{ 
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
?>
	<div class="ja-moduletable ja-masonry moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
		<div class="moduletable-inner clearfix">
			<?php echo $badge; ?>
			<?php if ($module->showtitle != 0) : ?>
			<h3><span><?php echo $module->title; ?></span></h3>
			<?php endif; ?>
			<div class="ja-box-ct clearfix">
			<?php echo $module->content; ?>
			</div>
		</div>
    </div>
	<?php
}

/*
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 */
function modChrome_JArounded($module, &$params, &$attribs)
{
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
?>
	<div class="ja-module ja-box-br module<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
	<div class="ja-box-bl"><div class="ja-box-tr"><div class="ja-box-tl clearfix">
		<?php echo $badge; ?>
		<?php if ($module->showtitle != 0) : ?>
		<h3><span><?php echo $module->title; ?></span></h3>
		<?php endif; ?>
		<div class="jamod-content ja-box-ct clearfix">
		<?php echo $module->content; ?>
		</div>
	</div></div></div>
	</div>
	<?php
}



function modChrome_tabsboot($module, &$params, &$attribs)
{
	
?>
	<div class="tabbable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
	
		<?php if ($module->showtitle != 0) : ?>
		<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><?php echo $module->title; ?></a></li>
		</ul>
		<?php endif; ?>
		<div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <p><?php echo $module->content; ?></p>
		

	</div>
	</div>
	</div>
	<?php
}


