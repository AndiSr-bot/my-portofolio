<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="home/img/favicon.png" type="image/png">
	<title>
		@yield('title')
	</title>
	@yield('styles')
	<style>
		.active {
			color: grey !important;
			text-decoration: underline;
		}
	</style>
</head>

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="main_menu" id="mainNav">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container box_1620">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="home/img/logo.png" width="300"
							alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link @yield('isHome')" href="{{ route('home') }}">
									Home
								</a></li>
							<li class="nav-item"><a class="nav-link @yield('isAbout')" href="{{ route('about') }}">
									About
								</a></li>
							<li class="nav-item"><a class="nav-link @yield('isServices')"
									href="{{ route('services') }}">
									Services
								</a></li>
							<li class="nav-item"><a class="nav-link @yield('isContact')" href="{{ route('contact') }}">
									Contact
								</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

	@yield('contents')

	<!--================Footer Area =================-->
	<footer class="footer_area p_120" style="padding-bottom:0px">
		<div class="container">
			<div class="row footer_inner">
				<div class="col-lg-8 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h3>About Me</h3>
						</div>
						<p>Do you want to be even more successful? Learn to love learning and growth. The more effort
							you put into improving your skills,</p>
					</aside>
				</div>
				<div class="col-lg-4 col-sm-6">
					<aside class="f_widget social_widget">
						<div class="f_title">
							<h3>Follow Me</h3>
						</div>
						<p>Let me be social</p>
						<ul class="list">
							@foreach($social as $item)
							<li><a href="{{ $item->link }}"><i class="fa fa-{{ $item->name }}"></i></a></li>
							@endforeach
						</ul>
						<br>
						<br>
						<p>
							Copyright &copy;
							<script>document.write(new Date().getFullYear());</script> All rights reserved
							<span><a href="{{ route('dashboard') }}" style="color:#000410">admin</a></span>
						</p>
					</aside>
				</div>
			</div>
		</div>
	</footer>
	<!--================End Footer Area =================-->
	@yield('etc')
	@yield('scripts')
</body>

</html>