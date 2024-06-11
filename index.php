<!DOCTYPE html>
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Inventory</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100" style="background-color: #3B3F5C; background-image: linear-gradient(190deg, #3B3F5C 0%,);">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<img src="img/logo.png" style="height: 150px; border-radius: 100%;">
						</div>
						<div class="text-center mt-4">
							<h1 class="color-white" style="color: white; font-size: 35px;">TVET Computer Laboratory Inventory System</h1>
							<p class="lead">
							</p>
						</div>
						<div class="card shadow" style="background-color: #ADD8E6;">
							<div class="card-body" style="background-color: #FFFFFF;">
								
								<br>
								<div class="m-sm-3">
									
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" id="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" id="password" placeholder="Enter your password" />
										</div>

										<div class="d-grid gap-2 mt-3">
										<button class="btn btn-lg btn-primary" type="button" id="form-submit" style="background-color: #0d6efd; color: white;"> Sign in</button>

										</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/app.js"></script>
	<script type="text/javascript">
		

        $(document).on("click", "#form-submit", ()=>{

	        $.ajax({
	            url:"api/user-login",
	            type: "POST",
	            dataType: "json",
	            data: {
	                email: $("#email").val(),
	                password: $("#password").val()
	            },
	            beforeSend: (e) => {
	            Swal.fire({
	              html: 'Loading...',
	              didOpen: () => {
	                Swal.showLoading()
	              }
	            })
	            },
	            success: async (data) => { 

	            Swal.close(); 

	            if (data.status == 1) {

		                Swal.fire({
		                  icon: 'success',
		                  title: 'Login succesfully.',
		                  confirmButtonColor: '#3085d6',
		                  cancelButtonColor: '#d33',
		                  confirmButtonText: 'Ok'
		                }).then((result) => {
		                  if (result.isConfirmed) {
		                    window.location.href = "http://localhost/mysystem/admin/?analytics";
		                  }
		                })

	            }else{
	                Swal.fire({
	                  icon: 'error',
	                  title: data.response,
	                  confirmButtonColor: '#3085d6',
	                  cancelButtonColor: '#d33',
	                  confirmButtonText: 'Ok'
	                }).then((result) => {
	                  if (result.isConfirmed) {
	                   
	                  }
	                })
	            }

	          }

	         }); 

        });

	</script>

</body>

</html>
