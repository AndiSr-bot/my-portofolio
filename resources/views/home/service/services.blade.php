@extends("home.layouts.layout")

@section("title", "Services | Andi's profile")
@section("isServices", "active")
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

<!--================Feature Area =================-->
<section style="padding-top:120px" class="feature_area feature_tow p_120">
	<div class="container">
		<div class="main_title">
			<h2>offerings to my clients</h2>
			<p>High-Quality, Customized Solutions for Our Client's Needs.</p>
		</div>
		<div class="feature_inner row">
			@foreach($service as $itemService)
			<div class="col-lg-4">
				<div class="feature_item" style="padding-bottom: 35px !important;">
					<h4>{{ $itemService->name }}</h4>
					<p class="text-justify">{{ $itemService->description }}</p>
					<div class="col-12 mt-3 px-0">
						<a href="{{ route('order-service', $itemService->id ) }}"
							class="btn btn-primary col-12">Order</a>
					</div>
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
<script src="home/js/mail-script.js"></script>
<script src="home/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="home/vendors/counter-up/jquery.counterup.min.js"></script>
<script src="home/js/theme.js"></script>
@endsection