<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();

// Supprimer le charset XHTML de Joomla!
$head = $document->getHeadData();
// unset($head['metaTags']['http-equiv']);
// $document->setHeadData($head);

var_dump($head);