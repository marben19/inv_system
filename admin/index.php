<?php
session_start();
if (!isset($_SESSION['system'])) {
	header('location: http://localhost/mysystem');
}
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<title>Admin</title>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
	<link href="https://cdn.datatables.net/v/bs5/dt-2.0.2/b-3.0.1/datatables.min.css" rel="stylesheet">
	<link href="../css/light.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
	<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

	<style type="text/css">
		@media print {
			html, body {
				width: 200mm;
				height: 150mm;
			}
			body {
				background-color: #f0f0f0;
			}
		}

		/* Background color for sidebar */
		.sidebar {
			background-color: #3B3F5C; /* Change this color to your desired sidebar background color */
			background-image: linear-gradient(190deg, #3B3F5C 0%, #3A416F 100%);
		}

		/* Background color for main content area */
		.main {
			background-color: #f8f9fa;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<main class="d-flex w-100" style="background-color: #3B3F5C; background-image: linear-gradient(190deg, #3B3F5C 0%, #3A416F 100%);">
			<nav id="sidebar" class="sidebar js-sidebar">
				<div class="sidebar-content js-simplebar">
					<a class="sidebar-brand" href="index.html">
						<span class="align-middle">TCLIS</span>
				</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header"></li>
					<li class="sidebar-item <?php if (isset($_GET['analytics'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?analytics">
							<i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['css1'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?css1">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">CSS 1</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['css2'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?css2">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">CSS 2</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['tvet'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?tvet">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">TVET Office</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['animation'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?animation">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">2D Animation</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['vgd'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?vgd">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">VGD</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['purchase'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?purchase">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Purchase</span>
						</a>
					</li>
					<li class="sidebar-item <?php if (isset($_GET['print'])) { echo 'active'; } ?>">
						<a class="sidebar-link" href="?print">
							<i class="align-middle" data-feather="printer"></i> <span class="align-middle">Print Labels</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" id="sign-out" style="cursor: pointer;">
							<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
						</a>
					</li>
				</ul>
				<div class="sidebar-cta"></div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<span class="text-dark ms-2">TVET Computer Laboratory Inventory System</span>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<span class="text-dark">Welcome! <?= $_SESSION['system'][0]['username'] ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="?profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>			
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<?php
					if (isset($_GET['analytics'])) {
						include 'pages/analytics.php';
					} else if (isset($_GET['profile'])) {
						include 'pages/profile.php';
					} else if (isset($_GET['css1'])) {
						include 'pages/css1.php';
					} else if (isset($_GET['purchase'])) {
						include 'pages/purchase.php';
					} else if (isset($_GET['css2'])) {
						include 'pages/css2.php';
					} else if (isset($_GET['tvet'])) {
						include 'pages/tvet.php';
					} else if (isset($_GET['animation'])) {
						include 'pages/animation.php';
					} else if (isset($_GET['vgd'])) {
						include 'pages/vgd.php';
					} else if (isset($_GET['inventory'])) {
						include 'pages/inventory.php';
					} else if (isset($_GET['print'])) {
						include 'pages/print.php';
					}
				?>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="" target="_blank"><strong>TCLIS</strong></a>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline"></ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/v/bs5/dt-2.0.2/b-3.0.1/datatables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>	
	<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script> 
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script> 
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
	<script src="../js/app.js"></script>
	<?php
		if (isset($_GET['analytics'])) {
			?> 
			<script src="js/analytics.js"></script> 
			<?php
		} else if (isset($_GET['profile'])) {
			?> 
			<script src="js/profile.js"></script> 
			<?php
		} else if (isset($_GET['css1'])) {
			?> 
			<script src="js/css1.js"></script> 
			<?php
		} else if (isset($_GET['purchase'])) {
			?> 
			<script src="js/purchase.js"></script> 
			<?php
		} else if (isset($_GET['css2'])) {
			?> 
			<script src="js/css2.js"></script> 
			<?php
		} else if (isset($_GET['tvet'])) {
			?> 
			<script src="js/tvet.js"></script> 
			<?php
		} else if (isset($_GET['animation'])) {
			?> 
			<script src="js/animation.js"></script> 
			<?php
		} else if (isset($_GET['vgd'])) {
			?> 
			<script src="js/vgd.js"></script> 
			<?php
		} else if (isset($_GET['inventory'])) {
			?> 
			<script src="js/inventory.js"></script> 
			<?php
		} else if (isset($_GET['print'])) {
			?> 
			<script src="js/print.js"></script> 
			<?php
		}
	?>
	<script type="text/javascript">
		$(document).on("click", "#sign-out", () => {
			$.ajax({
				url: "../api/user-logout",
				type: "POST",
				dataType: "json",
				data: {
					id: '<?= $_SESSION['system'][0]['id'] ?>'
				},
				beforeSend: (e) => {
					Swal.fire({
						html: 'Loading...',
						didOpen: () => {
							Swal.showLoading()
						}
					})
				},
				success: (data) => { 
					Swal.close(); 
					Swal.fire({
						icon: 'success',
						title: 'Logout successfully.',
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ok'
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = "http://localhost/mysystem/index.php";
						}
					})
				}
			}); 
		});
	</script>
</body>
</html>
