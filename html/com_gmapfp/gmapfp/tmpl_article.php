<?php
	/*
	* GMapFP Component Google Map for Joomla! 1.6.x
	* Version 9.15
	* Creation date: Avril 2012
	* Author: Fabrice4821 - www.gmapfp.org
	* Author email: webmaster@gmapfp.org
	* License GNU/GPL
	*------------------------
	* modif LM le 28/10/12
	* affichage condensé
	* paramètres gmapfp: affichage description OUI
	* components\com_gmapfp\libraries\map_v3.phpmap_v3.php :
	* mettre scrolling sur auto (ligne 133)
	*/

defined('_JEXEC') or die('Restricted access'); 

$height_msg = '400px';
$width_msg = '600px';

$itemid = JRequest::getVar('Itemid', 0, '', 'int');
$layout = JRequest::getVar('layout', '', '', 'str');

$row=$this->lieu;

?>
<?php 
if (@$row->adresse!=null) {$adr   = addslashes(trim($row->adresse))."<br />";}else{$adr='';};
if (@$row->adresse2!=null)    {$adr2  = addslashes(trim($row->adresse2))."<br />";}else{$adr2='';};
if (@$row->codepostal!=null)  {$cp    = addslashes(trim($row->codepostal))."&nbsp;";}else{$cp='';};
if (@$row->ville!=null)       {$ville = addslashes(trim($row->ville));}else{$ville='';};
if (@$row->departement!=null) {$dep   = addslashes(trim($row->departement));}else{$dep='';};
if (@$row->pay!=null)         {$pays  = "<br />".addslashes(trim($row->pay));}else{$pays='';};

if ($row->tel!=null) {$tel  = "<br />".addslashes(trim($row->tel));}else{$tel='';};

if ($row->web!=null) {
	if (substr($row->web,0,5)!="http:") {$lien_web = "http://".$row->web;} else {$lien_web = $row->web;};
	$web = '<br /><span><a href='.$lien_web.' target="_blank" > '.$lien_web.' </a></span> <br />';
} else {
	$web = '';
};

$adresse = $adr.$adr2.$cp.$ville.$dep.$pays.$tel.$web;
?>
<style type="text/css">
body {font-family: "arial","sans-serif"; font-size:80%;}
h2 {margin-top:0; margin-bottom:10px; border-bottom:dotted 2px #bbb;}
.gmapfp_message {display:none;}
</style>
	<h2><?php echo $row->nom; ?></h2>
	<p><?php echo $adresse; ?></p>

