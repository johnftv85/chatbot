<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>

	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- FontAwesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!-- Custom styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assents/styles.css') }}">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
                    <span><a href="https://www.linkedin.com/company/business-ecosystem-experience-s-a-s/" target="_blank"><i class="fab fa-linkedin"></i></a></span>
                    <span><a href="https://www.instagram.com/bexsoluciones/" target="_blank"><i class="fab fa-instagram"></i></a></span>
                    <span><a href="https://bexsoluciones.com/" target="_blank"><i class="fab fa-google-plus-square"></i></a></span>
                    <span><a href="https://www.youtube.com/@bexsoluciones" target="_blank"><i class="fab fa-youtube"></i></a></span>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('login') }}" method="post">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Email" name="email">
					</div>

					<!-- Campo de contraseña con ojito -->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" id="password" class="form-control" placeholder="Password" name="password">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
								<i id="toggleIcon" class="fas fa-eye"></i>
							</button>
						</div>
					</div>

					<div class="row align-items-center remember">
						<input type="checkbox"> Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account? <a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
	function togglePassword() {
		var passwordField = document.getElementById("password");
		var toggleIcon = document.getElementById("toggleIcon");

		if (passwordField.type === "password") {
			passwordField.type = "text";
			toggleIcon.classList.remove("fa-eye");
			toggleIcon.classList.add("fa-eye-slash");
		} else {
			passwordField.type = "password";
			toggleIcon.classList.remove("fa-eye-slash");
			toggleIcon.classList.add("fa-eye");
		}
	}
</script>

</body>
</html>
