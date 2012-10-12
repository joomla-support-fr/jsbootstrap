<?php  
defined( '_JEXEC' ) or die;

// Titre du site
$document = JFactory::getDocument();
$app = JFactory::getApplication();

?>
  
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<jdoc:include type="head" />
<?php // ==== Le styles ?>
<?php // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> ?>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" media="screen" />

<?php // ==== Le HTML5 shim, for IE6-8 support of HTML5 elements ?>
<!--[if lt IE 9]>
<script src="html5shim.googlecode.com/svn/trunk/html5...;></script>
<![endif]-->

<?php // ==== Le fav and touch icons ?>
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/ico/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/ico/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/ico/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/ico/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/ico/apple-touch-icon-57x57.png" />

</head>

<body>
  <jdoc:include type="message" />
  <div id="frame" class="outline">
	<div class="container well " style="padding-top:40px;">
	<div class="row">
		<div class="offset3 span6">
		    <?php if ($app->getCfg('offline_image')) : ?>
				<img src="<?php echo $app->getCfg('offline_image'); ?>" alt="<?php echo $app->getCfg('sitename'); ?>" />
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="offset4 span4">
    <?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != ''): ?>
		<h4><?php echo $app->getCfg('offline_message'); ?></h4>
    <?php elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
		<p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
	<?php endif; ?>
    <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" id="form-login">
      <fieldset class="input">
        <p id="form-login-username">
          <label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
          <input type="text" name="username" id="username" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="18" />
        </p>
        <p id="form-login-password">
          <label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
          <input type="password" name="password" id="password" class="inputbox" alt="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="18" />
        </p>
        <p id="form-login-remember">
          <input type="checkbox" name="remember" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?>" id="remember" />
          <label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?></label>
        </p>
        <p id="form-login-submit">
          <label>&nbsp;</label>
          <input type="submit" name="Submit" class="button btn btn-primary" value="<?php echo JText::_('JLOGIN'); ?>" />
        </p>
      </fieldset>
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="user.login" />
      <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()); ?>" />
      <?php echo JHTML::_( 'form.token' ); ?>
    </form>

		</div>
		</div>
	</div>
	</div>
  </div>
</body>

</html>