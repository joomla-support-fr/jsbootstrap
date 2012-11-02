<?php 
/*------------------------------------------------------------------------
# author    your name or company
# copyright Copyright (C) 2011 example.com. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.example.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die; 

// variables
$tpath = $this->baseurl.'/templates/'.$this->template;


?><!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <title><?php echo $this->error->getCode().' - '.$this->title; ?></title>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> <!-- mobile viewport optimized -->
  <link rel="stylesheet" href="<?php echo $tpath ?>/css/error.css" type="text/css" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/img/ico/apple-touch-icon-57x57.png"> <!-- iphone, ipod, android -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/img/ico/apple-touch-icon-72x72.png"> <!-- ipad -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/img/ico/apple-touch-icon-114x114.png"> <!-- iphone retina -->
  <link href="<?php echo $tpath; ?>/img/ico/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" /> <!-- favicon -->
</head>

<body>
  <div class="vh-center">
    <div>
      <h1> <img src="<?php echo $this->baseurl.'/templates/jsbootstrap/img/logo.png'; ?>" /></h1>
      <?php 
        echo $this->error->getCode().' - '.$this->error->getMessage(); 
        if (($this->error->getCode()) == '404') {
          echo '<br />';
          echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND');
        }
      ?>
      <p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>: 
      <a href="<?php echo $this->baseurl; ?>/"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>.</p>
	  <a href="<?php echo $this->baseurl; ?>/index.php?option=com_search" title="<?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></a>
    </div>
  </div>
</body>

</html>
