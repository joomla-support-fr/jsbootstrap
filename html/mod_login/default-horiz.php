<?php
/**
 * @package				Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
	} endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php else : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<fieldset class="userdata">
	
	

           
	
	<form class="navbar-form pull-right">
	
	


        <input class="span2" type="text" name="username" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
	<input class="span2" type="password" name="password" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />


	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>

	<input class="span" type="checkbox" name="remember" class="inputbox" value="yes"/> <?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>

	
	 </form>
	<?php endif; ?>

		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGIN') ?>" />
		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
			</li>
			<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
			</li>
			<?php endif; ?>
		</ul>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
<?php endif; ?>
