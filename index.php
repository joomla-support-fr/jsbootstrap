<?php
defined('_JEXEC') or die;

// Titre du site
$document = JFactory::getDocument();
$app = JFactory::getApplication();

// Supprimer le charset XHTML de Joomla!
$head = $document->getHeadData();
unset($head['metaTags']['http-equiv']);
unset($head['metaTags']['standard']['language']);
$document->setHeadData($head);

// Variables actives (pour créer des styles css selon contenu)
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$menu = & JSite::getMenu();
$sitehome = (($menu->getActive() == $menu->getDefault()) ? "sitehome " : "");

// Mise en page pour la largeur
$gridfluid = (($this->params->get('tpl-layout') == 1) ? "-fluid" : "");

// Position de la navbar
$navbar_position = $this->params->get('navbar-position'); 
$css_file = $this->params->get('css-file'); 

// Suffixe pour l'ID wrapper-body si pas de navbar en top
// $navbar_notop = (($this->countModules('navbar') & ($navbar_position != "navbar-fixed-top"))? "-notop" : "");
$withtop = (($this->countModules('navbar') & ($navbar_position != "navbar-fixed-top"))? "" : " withtop");
$withbottom = ($this->countModules('footer-fixed') ? " withbottom" : "");

// Suffixe si partie droite du navbar flotte
$navbar_float = (($this->params->get('navbar-right-phone')=='float') ? "-float" : ""); 

// largeur des sidebar
$span_left 	  = ($this->countModules('sidebar-left') ? ($this->params->get('tpl-span-left', 2)) : 0 );
$span_right	  = ($this->countModules('sidebar-right') ? ($this->params->get('tpl-span-right', 2)) : 0) ;
$span_content = 12 - $span_left - $span_right;

// largeur des blocs usertop
$nb_bloc = 0;
if($this->countModules('user-top-1')) { $nb_bloc += 1;}
if($this->countModules('user-top-2')) { $nb_bloc += 1;}
if($this->countModules('user-top-3')) { $nb_bloc += 1;}
if($this->countModules('user-top-4')) { $nb_bloc += 1;}
$span_usertop = ($nb_bloc > 0 ? (12 / $nb_bloc) : 0); 
// largeur des blocs userbottom
$nb_bloc = 0;
if($this->countModules('user-bottom-1')) { $nb_bloc += 1;}
if($this->countModules('user-bottom-2')) { $nb_bloc += 1;}
if($this->countModules('user-bottom-3')) { $nb_bloc += 1;}
if($this->countModules('user-bottom-4')) { $nb_bloc += 1;}
$span_userbottom = ($nb_bloc > 0 ? (12 / $nb_bloc) : 0); 

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<meta charset="<?php echo $this->getCharset(); ?>" />
	<?php $this->setGenerator(null); // cacher joomla dans la balise générator (pour les hackers!) ?>
			<?php if ($this->params->get('tpl-jquery', 1)) : ?>
	
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" media="screen" />
	<?php if ($css_file!='-1') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/<?php echo $css_file ?>" type="text/css" media="screen" />
	<?php endif; ?>

	<?php // ==== Le HTML5 shim, for IE6-8 support of HTML5 elements ?>
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php // ==== Le fav and touch icons ?>
	<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/favicon.png" />
	<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/favicon.ico" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ico/apple-touch-icon-57x57.png /">
	
	<!-- appel jQuery avant type head -->
	
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.js"></script>
	<?php endif; ?>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap-tab.js"></script>
	<script type="text/javascript">
jQuery.noConflict();

	</script>
	<jdoc:include type="head" />



</head>

<body class="<?php echo $sitehome . $option . " view-" . $view . " layout-" . $layout . " task-" . $task . " itemid-" . $itemid . " " . "grid" . $gridfluid ;?> ">
	<?php 
	// ==== navbar : barre de menu fixe en haut/bas de la fenêtre === 
	// #TODO: affichage sur 2 lignes en mode phone si menu-top-right actif 	
	?>
	<?php if($this->countModules('navbar')) : ?>
		<nav class="navbar <?php echo $navbar_position ?>">
			<div class="navbar-inner">
				<div class="container<?php echo $gridfluid; ?>">
					
					<?php // ---- le bouton menu en mode phone ?>
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					
					<?php // ---- a gauche du menu-top ?>
					<?php if ($this->params->get('navbar-left-type')!='none'): ?>
						<div class="navbar-left">
							<?php if ($this->params->get('navbar-left-type')=='position'): ?>
								<jdoc:include type="modules" name="<?php echo $this->params->get('navbar-left-pos') ?>" style="none" />
							<?php else: ?>
								<span><a href="<?php echo $this->baseurl ?>/">
								<?php if ($this->params->get('navbar-left-type')=='logo'): ?>				
									<img src="<?php echo $this->params->get('navbar-left-image') ?>" alt="<?php echo $app->getCfg('sitename');  ?>">
								<?php else: ?>
									<div class="brand"><?php echo $app->getCfg('sitename'); ?></div>
								<?php endif; ?>
								</a></span> <?php // span pour IE7 ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php // ---- le menu-top ?>
					<div class="nav-collapse">
						<jdoc:include type="modules" name="navbar" style="none" />
					</div>

					<?php // ---- a droite du menu-top ?>
					<?php if ($this->params->get('navbar-right-type')!='none'): ?>
						<div class="navbar-right<?php echo $navbar_float ?>">
							<?php if ($this->params->get('navbar-right-type')=='position'): ?>
								<jdoc:include type="modules" name="<?php echo $this->params->get('navbar-right-pos') ?>" style="none" />
							<?php else: ?>
								<span><a href="<?php echo $this->baseurl ?>/">
								<?php if ($this->params->get('navbar-right-type')=='logo'): ?>				
									<img src="<?php echo $this->params->get('navbar-right-image') ?>" alt="<?php echo $app->getCfg('sitename');  ?>">
								<?php else: ?>
									<div class="brand"><?php echo $app->getCfg('sitename'); ?></div>
								<?php endif; ?>
								</a></span> <?php // span pour IE7 ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>  <?php // container ?>
			</div>  <?php // navbar-inner ?>
		</nav>  <?php // navbar ?>
	<?php endif; ?>

	<?php 
	// =============================================
	// div #wrapper-body : fixe décalage pour navbar 
	// ============================================= 
	?>
	<div class="wrapper-body<?php echo $withtop.$withbottom ?>">  
		<?php // header-body : bloc header sur largeur fenêtre ?>
		<?php if($this->countModules('header-body')) : ?>
			<header class="header-body">
				<div class="container<?php echo $gridfluid; ?>">
					<jdoc:include type="modules" name="header-body" style="none" />
				</div>
			</header>
		<?php endif; ?>

		<?php // menu-body : menu sur largeur fenêtre ?>
		<?php if($this->countModules('menu-body')) : ?>
		<nav class="menu-body">
			<div class="container<?php echo $gridfluid; ?>">
				<jdoc:include type="modules" name="menu-body" style="none" />
			</div>
		</nav>
		<?php endif; ?>

		<?php 
		// ==============================================================
		// div #wrapper-page : tous les blocs sauf navbar et footer-fixed
		// ============================================================== 
		?>
		<div class="wrapper-page<?php echo $this->params->get('class-wrapper-page') ?>">  
		
			<?php // header-page : bloc header sur la largeur du fond des contenus ?>
			<?php if($this->countModules('header-page')) : ?>
				<header class="header-page">
					<jdoc:include type="modules" name="header-page" style="none" />
				</header>
			<?php endif; ?>

			<?php // menu-page : menu sur la largeur du fond des contenus  ?>
			<?php if($this->countModules('menu-page')) : ?>
				<nav class="menu-page">
					<jdoc:include type="modules" name="menu-page" style="none" />
				</nav>
			<?php endif; ?>

			<?php // breadcrumb-top : fil d'ariane sur la largeur des contenus  ?>
			<?php if($this->countModules('breadcrumb-top')) : ?>
				<div class="breadcrumb-top"<?php echo $this->params->get('class-breadcrumb-top')?>>
					<jdoc:include type="modules" name="breadcrumb-top" style="none" />
				</div>
			<?php endif; ?>
			
			<?php //  ============== Début blocs alignés sur la grille 940 ============== ?>
			<div class="container<?php echo $gridfluid; ?>">
			
				<?php // user-top : 1 à 4 blocs justifiés sur la largeur grille ?>
				<?php if ($span_usertop>0) : ?>
					<div class="wrapper-usertop<?php echo $this->params->get('class-wrapper-user-top') ?>"> 
						<div class="row<?php echo $gridfluid; ?>">
							<?php if($this->countModules('user-top-1')) : ?>
								<div class="span<?php echo $span_usertop; ?>"> 
								<div class="user-top-1<?php echo $this->params->get('class-user-top') ?>">
									<jdoc:include type="modules" name="user-top-1" style="xhtml" />
								</div>
								</div>
							<?php endif; // user-top-1 ?>
							<?php if($this->countModules('user-top-2')) : ?>
								<div class="span<?php echo $span_usertop; ?>"> 
								<div class="user-top-2<?php echo $this->params->get('class-user-top') ?>">
									<jdoc:include type="modules" name="user-top-2" style="xhtml" />
								</div>
								</div>
							<?php endif; // user-top-2 ?>
							<?php if($this->countModules('user-top-3')) : ?>
								<div class="span<?php echo $span_usertop; ?>"> 
								<div class="user-top-3<?php echo $this->params->get('class-user-top') ?>">
									<jdoc:include type="modules" name="user-top-3" style="xhtml" />
								</div>
								</div>
							<?php endif; // user-top-3 ?>
							<?php if($this->countModules('user-top-4')) : ?>
								<div class="span<?php echo $span_usertop; ?>"> 
								<div class="user-top-4<?php echo $this->params->get('class-user-top') ?>">
									<jdoc:include type="modules" name="user-top-4" style="xhtml" />
								</div>
								</div>
							<?php endif; // user-top-4 ?>
						</div>  <?php // row ?>
					</div>  <?php // wrapper-usertop ?>
				<?php endif; // span_usertop > 0 ?>
				
				<?php // ====== la partie centrale du contenu ====== ?>
				<div class="wrapper-middle<?php echo $this->params->get('class-wrapper-middle')?>">
					<div class="row<?php echo $gridfluid; ?>">

						<?php // Colonne de gauche
						if($this->countModules('sidebar-left')) : ?>
							<aside class="span<?php echo $span_left; ?>"> 
								<div class="sidebar-left<?php echo $this->params->get('class-sidebar-left')?>">
									<jdoc:include type="modules" name="sidebar-left" style="xhtml" />
								</div>
							</aside>
						<?php endif;  // Colonne de gauche ?>

						<?php // Colonne centrale ?>
						<div class="wrapper-middle-content<?php echo $this->params->get('class-wrapper-middle-content')?>">
							<div class="span<?php echo $span_content; ?>">
							<?php // < div class="container-fluid "> est-ce nécessaire ??>
									<?php // module au-dessus du contenu
									if($this->countModules('content-top')) : ?>
										<div class="row-fluid"> 
											<div class="span12"> 
												<div class="content-top<?php echo $this->params->get('class-content-top')?>">
													<jdoc:include type="modules" name="content-top" style="none" />
												</div>
											</div>
										</div>
									<?php endif; // module au-dessus du contenu ?>

									<?php // partie réservée aux articles et composants ?>
									<div class="row-fluid"> 
										<div class="span12"> 
											<div class="component<?php echo $this->params->get('class-component')?>">
												<jdoc:include type="message" />
												<jdoc:include type="component" />
											</div>
										</div>
									</div>
									
									<?php // module au-dessous du contenu
									if($this->countModules('content-bottom')) : ?>
										<div class="row-fluid"> 
											<div class="span12"> 
												<div class="content-bottom<?php echo $this->params->get('class-content-bottom')?>">
													<jdoc:include type="modules" name="content-bottom" style="none" />
												</div>
											</div>
										</div>
									<?php endif;  // module au-dessous du contenu ?>
									
							</div> <?php // .span colonne centrale ?>
						</div> <?php // #wrapper-middle-content ?>

						<?php // Colonne de droite
						if($this->countModules('sidebar-right')) : ?>
							<aside class="span<?php echo $span_right; ?>"> 
								<div class="sidebar-right<?php echo $this->params->get('class-sidebar-right')?>">
									<jdoc:include type="modules" name="sidebar-right" style="xhtml" />
								</div>
							</aside>
						<?php endif; // Colonne de droite ?>

					</div> <?php //row wrapper-middle ?>
				</div> <?php //wrapper-middle ?>
				<?php // ====== fin de la partie centrale du contenu ====== ?>
				
				<?php // user-bottom : 1 à 4 blocs justifiés sur la largeur grille
				if ($span_userbottom>0) : ?>
					<div class="wrapper-userbottom<?php echo $this->params->get('class-wrapper-user-bottom')?>"> 
						<div class="row<?php echo $gridfluid; ?>">
							<?php if($this->countModules('user-bottom-1')) : ?>
								<div class="span<?php echo $span_userbottom; ?>"> 
									<div class="user-bottom-1<?php echo $this->params->get('class-user-bottom')?>">
										<jdoc:include type="modules" name="user-bottom-1" style="none" />
									</div>
								</div>
							<?php endif; // user-bottom-1 ?>
							<?php if($this->countModules('user-bottom-2')) : ?>
								<div class="span<?php echo $span_userbottom; ?>"> 
									<div class="user-bottom-2<?php echo $this->params->get('class-user-bottom')?>">
										<jdoc:include type="modules" name="user-bottom-2" style="none" />
									</div>
								</div>
							<?php endif; // user-bottom-2 ?>
							<?php if($this->countModules('user-bottom-3')) : ?>
								<div class="span<?php echo $span_userbottom; ?>"> 
									<div class="user-bottom-3<?php echo $this->params->get('class-user-bottom')?>">
										<jdoc:include type="modules" name="user-bottom-3" style="none" />
									</div>
								</div>
							<?php endif; // user-bottom-3 ?>
							<?php if($this->countModules('user-bottom-4')) : ?>
								<div class="span<?php echo $span_userbottom; ?>"> 
									<div class="user-bottom-4<?php echo $this->params->get('class-user-bottom')?>">
										<jdoc:include type="modules" name="user-bottom-4" style="none" />
									</div>
								</div>
							<?php endif; // user-bottom-4 ?>
						</div><?php // row ?>
					</div><?php // wrapper-userbottom ?>
				<?php endif; // span_userbottom > 0 ?> 

				<?php // breadcrumb-bottom : fil d'ariane sur la largeur des contenus 
				if($this->countModules('breadcrumb-bottom')) : ?>
					<div class="breadcrumb-bottom"<?php echo $this->params->get('class-breadcrumb-bottom')?>>
						<jdoc:include type="modules" name="breadcrumb-bottom" style="none" />
					</div>
				<?php endif; // breadcrumb-bottom ?>
				
				<?php // footer : justifié sur la largeur des contenus
				if($this->countModules('footer')) : ?>
					<footer class="footer">
						<jdoc:include type="modules" name="footer" style="none" />
					</footer>
				<?php endif; // footer ?>
				
			</div> 	<?php // .container ?>
			<?php // ============== fin des blocs alignés sur la grille 940 ============== ?>
			
			<?php // footer-page : justifié sur la largeur du fond des contenus
			if($this->countModules('footer-page')) : ?>
				<footer class="footer-page">
					<jdoc:include type="modules" name="footer-page" style="none" />
				</footer>
			<?php endif; // footer-page ?>
			
		</div><?php //.wrapper-page ?>

		<?php // footer-body : justifié sur la largeur du fond des contenus
		if($this->countModules('footer-body')) : ?>
			<footer class="footer-body">
				<jdoc:include type="modules" name="footer-body" style="none" />
			</footer>
		<?php endif; // footer-body ?>

	</div><?php // .body-wrapper ?>

	<?php 
	// ==== footer-bottom : barre fixe en bas de la fenêtre ==== 	
	?>
	<?php if($this->countModules('footer-fixed')) : ?>
		<nav class="navbar navbar-fixed-bottom">
			<div class="navbar-inner">
				<div class="container<?php echo $gridfluid; ?>">
					<div class="footer-fixed">
						<jdoc:include type="modules" name="footer-fixed" style="none" />
					</div>
				</div>
			</div>
		</nav>
	<?php endif; // footer-fixed-bottom ?>

	<jdoc:include type="modules" name="debug" />

	<?php 
	// JAVASCRIPT
	// ================================================== 
	// Mis en fin du document pour un chargement plus rapide des pages ?>


</body>
</html>