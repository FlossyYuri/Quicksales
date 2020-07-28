<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
if (!isset($CI)) {
	$CI = new CI_Controller();
}
$CI->load->helper('url');

$link_home = site_url("principal");
$link_meus = site_url("userLinks/meusAnuncios");
$link_anunciar = site_url("userLinks/anunciar");
$link_desejos = site_url("userLinks/desejos");
$link_dados = site_url("userLinks/dados_pessoais");
$link_sair = site_url("usuario/sair");
$link_login = site_url("userLinks");
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Site configs  -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/ai/quick mini red.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/ai/quick mini red.png'); ?>">
	<title>Pagina não encontrada.</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom/main.css'); ?>" />


</head>

<body>
	<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	$logged = $CI->session->has_userdata('usuario');
	if ($logged) {
		$userdata = $CI->session->userdata('usuario');
	}
	$link_home = site_url("principal");
	$link_meus = site_url("userLinks/meusAnuncios");
	$link_anunciar = site_url("userLinks/anunciar");
	$link_desejos = site_url("userLinks/desejos");
	$link_dados = site_url("userLinks/dados_pessoais");
	$link_sair = site_url("usuario/sair");
	$link_login = site_url("userLinks");
	?>
	<!--Main Navigation-->
	<header>
		<div class="container-xl top-bar d-none d-lg-block">
			<div class="row my-2">
				<div class="col-md-6">
					<ul>
						<li>
							<a href="<?php echo $link_home ?>" class="p-0"><img style="height: 35px;" src="<?php echo base_url("assets/ai/quick.png") ?>" alt="" /></a>
						</li>
						<?php if ($logged) : ?>
							<li>
								<a href="<?php echo $link_meus ?>" class="btn btn-outline-main waves-effect d-flex"><i class="fas fa-list-ul"></i> Meus anúncios</a>
							</li>
						<?php endif ?>
						<li>
							<a href="<?php echo $link_anunciar ?>" class="btn bg-main d-flex text-white"><i class="fas fa-plus left"></i> Anunciar</a>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul class="d-flex justify-content-end">
						<?php if ($logged) : ?>
							<li>
								<a href="<?php echo $link_desejos ?>" class="btn btn-outline-main waves-effect d-flex"><i class="far fa-heart"></i> Desejos</a>
							</li>
						<?php endif ?>
						<?php if ($logged) : ?>
							<li>
								<!--Dropdown primary-->
								<div class="dropdown">

									<!--Trigger-->
									<a class="btn btn-outline-main waves-effect d-flex dropdown-toggle" id="minhaConta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i>Minha conta</a>


									<!--Menu-->
									<div class="dropdown-menu dropdown-danger">
										<a class="dropdown-item" href="<?php echo $link_meus ?>">Meus anúncios</a>
										<a class="dropdown-item" href="<?php echo $link_desejos ?>">Desejos</a>
										<a class="dropdown-item" href="#modalInteresses" data-toggle="modal" data-target="#modalInteresses">Meus interesses</a>
										<a class="dropdown-item" href="<?php echo $link_dados ?>">Dados Pessoais</a>
										<a class="dropdown-item" href="<?php echo $link_sair ?>">Sair</a>
									</div>
								</div>
								<!--/Dropdown primary-->
							</li>
						<?php else : ?>
							<li>
								<a href="<?php echo $link_login ?>" class="btn btn-outline-main waves-effect d-flex"><i class="far fa-user-circle"></i>
									Entrar/Registrar
								</a>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-main">
			<div class="container-xl flex-column">
				<!-- Large outline input -->
				<div class="col-sm-12 p-0">
					<!-- Material background input -->
					<div class="md-form md-bg m-1 z-depth-1">
						<input type="text" id="pesquisa" placeholder="Pesquisar" class="form-control" />
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!--Main Navigation-->

	<!--Bottom Bar-->
	<div class="container-fluid bg-main bottom-bar p-0 fixed-bottom z-depth-3 d-lg-none">
		<div class="d-flex justify-content-around align-items-center">
			<div class="text-center">
				<a href="<?php echo $link_home ?>" class="btn-floating z-depth-0 mx-0 d-flex align-items-center justify-content-center"><img src="<?php echo base_url('assets/ai/quick-mini-white-min.png') ?>" alt="logo" /><span>home</span></a>
			</div>
			<div class="text-center">
				<a type="button" data-activates="categories" class="btn-floating z-depth-0 mx-0 button-collapse"><i class="fas fa-list-ul"><span>categorias</span></i></a>
			</div>
			<div class="text-center">
				<a href="<?php echo $link_anunciar ?>" type="button" class="btn-floating z-depth-0 mx-0"><i class="fas fa-plus"><span>Anunciar</span></i></a>
			</div>
			<?php if ($logged) : ?>
				<div class="text-center">
					<a type="button" data-activates="profile" class="btn-floating  z-depth-0 mx-0 button-collapse"><i class="far fa-user-circle"><span>Minha Conta</span></i></a>
				</div>
			<?php else : ?>
				<div class="text-center">
					<a href="<?php echo $link_login ?>" type="button" class="btn-floating  z-depth-0 mx-0"><i class="fas fa-sign-in-alt"><span>Entrar</span></i></a>
				</div>
			<?php endif ?>
		</div>
	</div>
	<!--Bottom Bar-->

	<!-- Main Start -->
	<main class="py-2 d-flex align-items-center">
		<div class="container-xl">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<div class="">
						<h3 style="font-size: 3rem; color: var(--main-color);font-weight: 600"><?php echo $heading ?></h3>
						<p style="font-weight: 500" class="text-muted"><?php echo $message ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<img width="80%" src="<?php echo base_url('assets/img/svg/not_found_404.svg') ?>" alt="Pagina não encontrada.">
				</div>
			</div>
		</div>
	</main>
	<!-- End Main -->

	<!-- Footer -->
	<footer class="page-footer font-small bg-dark-main">
		<!-- Copyright -->
		<div class="container">
			<div class="py-3 d-flex justify-content-between">
				<span>Copyright © Todos direitos reservados</span>
				<span>Criado por:
					<a href="https://chillstudio.co.mz" class="text-uppercase">CS Chill Studio MZ</a></span>
			</div>
		</div>
		<!-- Copyright -->
	</footer>
	<!-- Footer -->

	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js') ?>"></script>
</body>

</html>