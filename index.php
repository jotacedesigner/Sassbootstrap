<?php
/**
 * @package     Diseño Sitio Web Informa-t
 * @subpackage  DSWED
 * @copyright   Copyright (C) 2022 - Informa-t JotaCe Designer, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
ini_set('display_errors','off');
defined('_JEXEC') or die;

$app  = JFactory::getApplication();
$active = JFactory::getApplication()->getMenu()->getActive();
$doc  = JFactory::getDocument();
$task = $app->input->getCmd('task', '');
$user = JFactory::getUser();
$doc->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js'];

JHtml::_('bootstrap.framework',false);//Desabilitar JS de Bootstrap Old
unset($this->_scripts['/media/system/js/mootools-core.js']); 
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']); // Remove joomla core bootstrap

$this->language  = $doc->language;
$this->direction = $doc->direction;
$this->setGenerator(''); //Eliminar el meta de joomla

// Getting params from template
$params = $app->getTemplate(true)->params;
// Detecting Active Variables//
$input    = JFactory::getApplication()->input;
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$itemid   = $app->input->getCmd('Itemid', '');
$class    = " educatic-" . $view;
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Preload CSS
$mediaVersion = $this->mediaVersion ? '?' . $this->mediaVersion : '';
$this->addHeadLink($this->baseurl . '/templates/' . $this->template . '/css/main.min.css' . $mediaVersion, 'preload', 'rel',  array('as' => 'style', 'media' => 'all'));

// Load CSS
JHtml::_('stylesheet', 'main.min.css',  array('version' => 'auto', 'relative' => true));
if($view!=featured) { 
  JHtml::_('stylesheet', 'editor.css', array('version' => 'auto', 'relative' => true,'media' => 'all'));
}
$doc->addStyleSheet('templates/' . $this->template . '/css/all.min.css'. $mediaVersion, 'text/css', 'all');
$doc->addStyleSheet('templates/' . $this->template . '/css/main.min.css'. $mediaVersion, 'text/css', 'all');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));
///Cargar una fuente de google
if ($this->params->get('googleFont'))
{
  JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
  $this->addStyleDeclaration("
  h3.catItemTitle a {
    font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
    font-size:30px;
 
  }");
}
///Cargar una fuente de google para el cuerpo del sitio
if ($this->params->get('bodygood'))
{
  JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $this->params->get('bodygoodfont'));
  $this->addStyleDeclaration("
div.catItemIntroText,.site-navbar{
    font-family: '" . str_replace('+', ' ', $this->params->get('bodygoodfont')) . "', sans-serif;
    font-size:16px;
    color:#777
 
  }
  div#educatic-main{
    font-family: '" . str_replace('+', ' ', $this->params->get('bodygoodfont')) . "', sans-serif;
    font-size:58px;
    color:#777
 
  }");
}
?>
<!DOCTYPE HTML>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if (gte IE 6)&(lte IE 8)]>
    <script src="/temples/educatic/html5shiv.js"></script>
    <script src="/temples/educatic/respond.min.js"></script>
    <![endif]-->

    <!--[if lt IE 9]>
                <script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
        <![endif]-->
    <!-- Required meta tags -->

<head>
<meta  charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7,9,10" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta property="og:type" content="article"/>
    <link rel="preconnect dns-prefetch" href="https://www.google-analytics.com">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<title>Informa-t</title> 

<!-- Favicons -->

<link rel="shortcut icon" href="https://informatemigrante.org/templates/inforamat/favicon.ico" />
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">

<!-- Fonts -->

<link href='https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<jdoc:include type="head" /> 
</head>
<body>
<header id="social-media" class="mb-3">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a class="navbar-brand" href=""><img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/Logo_informat.png"  width="180" alt="Logo Informa-t"></a>
			</div>
			<div class="col-md-6 top-social d-flex justify-content-end">
				<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
				<a href="#"><i class="fa-brands fa-twitter"></i></a>
				<a href="#"><i class="fa-brands fa-instagram"></i></a>
			</div>
		</div>
	</div>
</header>	   
 <!-- Navigation--> 
<nav class="navbar navbar-expand-lg navbar-light bg-primary sticky-top py-3 shadow" id="mainNav">
    <div class="container px-4 px-lg-5">
			<div class="col-4">
				<a class="navbar-brand" href="#page-top">
					<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/camino-protegido.png" alt="" width="120" />
				</a>
			</div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
				<jdoc:include type="modules" name="menu" style="none" />
            </div>

			<div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">
            <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
              <span></span>
            </a>
          </div>
	</div>
</nav>

<!-- Content -->
<section id="hero" class="hero position-relative">
<div class="d-flex min-vh-100" lc-helper="background" style="background:url(<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/work.jpg)  center / cover no-repeat; background-color:#444; background-blend-mode: overlay;">
</div>	
</section>
<!-- Services --> 
<div class="icon-boxes position-relative">
	<div class="container position-relative">
	  <div class="row-base row justify-content-center">
		<div class="card shadow me-3 p-3 bg-white col-md-4" style="width: 15rem;">
			<img class="card-img-top" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/Plan_Logo.png" width="140" alt="Logo Plan">
		</div>
		<div class="card me-3 shadow p-3 bg-white col-md-4">	
			<img class="card-img-top" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/LOGO-EDUCO.png" width="140" alt="Logo Educo">
		</div>
		<div class="card me-3 shadow p-3 bg-white col-md-4">
			<img class="card-img-top" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/caya.png" width="140" alt="Logo Cayaguanca">
		</div>
	  </div>
	</div>
   </div>
<!-- Servicios Informat -->
<section id="specialization" class="servicios-informat section bg-primary">
	<div class="container">
	   <div class="section-body">
		   <div class="row row-cols-2 row-cols-lg-3 justify-content-center">
			   <div class="col-4 p-3 col-lg-2 d-flex detail_informat">
				<!-- Icon Servicio -->
				   <div class="icon me-3">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/servicio.svg" alt="Servicio">
				   </div>
				   <!-- Texto -->
				   <div class="col flex-column">
						<h3 class="informat-title">SERVICIO</h3>
						<span class="inoformat-type">de Atención</span>
				   </div>
			   </div>
			<div class="col-4 p-3 col-lg-2 d-flex detail_informat">
				  	<!-- Icon Servicio -->
					  <div class="icon me-3">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/registro.svg" alt="Servicio">
				   </div>
				   <!-- Texto -->
				   <div class="col flex-column">
					<h3 class="informat-title">REGISTRO Y MONITOREO</h3>
					<span class="inoformat-type">de Casos</span>
				   </div>
			</div>
			<div class="col-4 p-3 col-lg-2 d-flex detail_informat">
				   	<!-- Icon Servicio -->
					   <div class="icon me-3">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/oprtu.svg" alt="Servicio">
				   </div>
				   <!-- Texto -->
				   <div class="col flex-column">
					<h3 class="informat-title">OPORTUNIDADES</h3>
					<span class="inoformat-type">disponibles</span>
				   </div>
			</div><!-- End box service -->
			<div class="col-4 p-3 col-lg-2 d-flex detail_informat">
				   	<!-- Icon Servicio -->
					   <div class="icon me-3">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/biblio.svg" alt="Servicio">
				   </div>
				   <!-- Texto -->
				   <div class="col flex-column">
					<h3 class="informat-title">BIBLIOTECA</h3>
					<span class="inoformat-type">de noticias</span>
				   </div>
			</div><!-- End box service -->
			   
			<div class="col-4 p-3 col-lg-2 d-flex">
					<!-- Icon Servicio -->
					<div class="icon me-3">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/aten.svg" alt="Servicio">
				   </div>
				   <!-- Texto -->
				   <div class="col flex-column">
					<h3 class="informat-title">ATENCIÓN DE CASOS</h3>
					<span class="inoformat-type">victimas de violencia</span>
				   </div>
				</div><!-- End box service -->
		   </div>
	   </div>
	</div>
 </section>

<!-- Divider -->
   <div class="container d-flex aligns-items-center justify-content-center">
	<h2 class="divider line one-line" contenteditable >
		<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/curve.png" width="200" alt="curve">
	</h2>
   </div>
<!-- Banner -->
<section class="section-banner">
	<div class="container">
		<div class="row-base row">
			<header class="col-base col-md-9">
            <jdoc:include type="component" />
					<h2 class="banner-title">Informacion</h2>
			</header>
		
		</div>
	</div>
</section>
<section id="banner">
	<div class="container aos-init aos-animate" data-aos="zoom-in">
		<div class="section-header d-flex">
			<div class="col-lg-6 col-md-6 me-3">
				<h2>Lorem</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
			</div>
			<div class="col-lg-6 col-md-6 text-end">
				<button type="submit" class="ms-2">Contacto</button>
			</div>
		</div>
		
			
		</div>
	
</div>
</section>
<section id="contenido">
	<div class="container">
		<!-- Main -->
		<jdoc:include type="modules" name="position-4" style="html5" />
		<row class="main">
		Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde dolorum veniam sequi eaque quasi distinctio laudantium illo soluta doloremque quos eius, amet recusandae totam, est hic expedita. Facere, saepe vel!
		</row>
	</div>
</section>
<!-- Footer -->
<footer class="footer">
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container">
			<a class="navbar-brand mx-auto d-lg-none" href="index.html">
				Informat <strong class="d-block">Migrante</strong>
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item nav-link active">
						<a class="nav-link" href="#inicio">Inicio</a>
					</li>
					<li class="nav-item nav-link">
						<a class="nav-link" href="#comunidad">Comunidad</a>
					</li>
					<li class="nav-item nav-link">
						<a class="nav-link" href="#organizacion">Organizaciones</a>
					</li>
					<a class="navbar-brand ms-3 d-none d-lg-block logo-footer" href="index.html">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/Logo_informat.png" width="140" alt="Logo Informat">
					</a>
					<li class="nav-item nav-link">
						<a class="nav-link" href="#Como Ayudamos">Como Ayudamos</a>
					</li>
					<li class="nav-item nav-link">
						<a class="nav-link" href="#servicios">Servicios</a>
					</li>
					<li class="nav-item nav-link">
						<a class="nav-link active" href="#contactenos">Contactenos</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
<hr>
<div class="container">
<div class="row">
	<div class="col-12 top-social d-flex justify-content-center">
		<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
		<a href="#"><i class="fa-brands fa-twitter"></i></a>
		<a href="#"><i class="fa-brands fa-instagram"></i></a>
	</div>
	<div class="col-12 text-center mt-3">
		<p class="mb-0">Copyright ©<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Informa-t </p>
	</div>
</div>
</div>
<p class="pull-right">
        <a href="#top" id="back-top">
          <?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
        </a>
      </p>
</footer>
	
<!-- Scripts -->

<!-- <script src="js/jquery.min.js"></script> -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<?php JHtml::script(Juri::base() . 'templates/'. $this->template . 'js/bootstrap.bundle.min.js', array('version' => 'auto', 'relative' => true), array('defer' => 'defer'));?>
<?php JHtml::script(Juri::base() . 'templates/'. $this->template . 'js/main.js', array('version' => 'auto', 'relative' => true), array('defer' => 'defer'));?>
<?php JHtml::script(Juri::base() . 'templates/'. $this->template . 'js/scripts.js', array('version' => 'auto', 'relative' => true), array('defer' => 'defer'))?>

<!-- Icon Fontawesome -->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>