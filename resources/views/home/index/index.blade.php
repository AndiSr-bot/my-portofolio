@extends("home.layouts.layout")

@section("title", "Andi's profile")
@section("isHome", "active")
@section("styles")
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="home/css/bootstrap.css">
<link rel="stylesheet" href="home/vendors/linericon/style.css">
<link rel="stylesheet" href="home/css/font-awesome.min.css">
<link rel="stylesheet" href="home/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="home/vendors/lightbox/simpleLightbox.css">
<link rel="stylesheet" href="home/vendors/nice-select/css/nice-select.css">
<link rel="stylesheet" href="home/vendors/animate-css/animate.css">
<link rel="stylesheet" href="home/vendors/flaticon/flaticon.css">
<!-- main css -->
<link rel="stylesheet" href="home/css/style.css">
<link rel="stylesheet" href="home/css/responsive.css">
@endsection

@section("contents")
<!--================Home Banner Area =================-->
<section class="home_banner_area">
	<div class="banner_inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="home_left_img">
						<img src="home/img/banner/home-left-1.png" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="banner_content">
						<h5>This is me</h5>
						<h2>{{ $user->name }}</h2>
						<p>{{ $user->tagline }}</p>
						<a class="banner_btn" href="{{ route('services') }}">Hire me</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<section class="welcome_area p_120">
	<div class="container">
		<div class="row welcome_inner">
			<div class="col-lg-6">
				<div class="welcome_text">
					<h4>About Myself</h4>
					<p>{{ $user->description }}</p>
					<div class="row">
						@foreach($language as $itemLanguage)
						<div class="col-md-4">
							<div class="wel_item">
								<img src="{{ $itemLanguage->img }}" alt="" width="40px">
								<h5 class="mt-2">{{ $itemLanguage->level }}</h5>
								<p style="font-size:12px">{{ $itemLanguage->name }}</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="tools_expert">
					<h3>Tools Expertness</h3>
					<div class="skill_main">
						@foreach($tool as $itemTool)
						<div class="skill_item">
							<h4>{{ $itemTool->name }} <span class="counter">{{ $itemTool->counter }}</span>%</h4>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="{{ $itemTool->counter }}"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Welcome Area =================-->

<!--================Feature Area =================-->
<section class="feature_area p_120">
	<div class="container">
		<div class="main_title">
			<h2>offerings to my clients</h2>
			<p>High-Quality, Customized Solutions for Our Client's Needs.</p>
		</div>
		<div class="feature_inner row">
			@foreach($service as $itemService)
			<div class="col-lg-4 col-md-6">
				<div class="feature_item">
					<h4>{{ $itemService->name }}</h4>
					<p>
						{{ $itemService->description }}
					</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<!--================End Feature Area =================-->

@endsection

@section('scripts')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="home/js/jquery-3.2.1.min.js"></script>
<script src="home/js/popper.js"></script>
<script src="home/js/bootstrap.min.js"></script>
<script src="home/js/stellar.js"></script>
<script src="home/vendors/lightbox/simpleLightbox.min.js"></script>
<script src="home/vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="home/vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="home/vendors/isotope/isotope-min.js"></script>
<script src="home/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="home/js/jquery.ajaxchimp.min.js"></script>
<script src="home/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="home/vendors/counter-up/jquery.counterup.min.js"></script>
<script src="home/js/mail-script.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="home/js/gmaps.min.js"></script>
<script src="home/js/theme.js"></script>
@endsection