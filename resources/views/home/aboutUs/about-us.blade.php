@extends("home.layouts.layout")

@section("isAbout", "active")
@section("title", "About Me | Andi's profile")
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

<!--================Welcome Area =================-->
<section style="padding-top:120px" class="welcome_area p_120">
	<div class="container">
		<div class="row welcome_inner">
			<div class="col-lg-6">
				<div class="welcome_text">
					<h4>About Myself</h4>
					<p>
						{{ $user->description }}
					</p>
					<div class="row">
						@foreach($language as $itemLanguage)
						<div class="col-sm-4">
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
<script src="home/js/mail-script.js"></script>
<script src="home/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="home/vendors/counter-up/jquery.counterup.min.js"></script>
<script src="home/js/theme.js"></script>
@endsection