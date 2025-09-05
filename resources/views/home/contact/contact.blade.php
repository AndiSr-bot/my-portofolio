@extends("home.layouts.layout")

@section("title", "Contact Me | Andi's profile")
@section("isContact", "active")
@section("styles")
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="home/css/bootstrap.css">
<link rel="stylesheet" href="home/vendors/linericon/style.css">
<link rel="stylesheet" href="home/css/font-awesome.min.css">
<link rel="stylesheet" href="home/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="home/vendors/lightbox/simpleLightbox.css">
<link rel="stylesheet" href="home/vendors/nice-select/css/nice-select.css">
<link rel="stylesheet" href="home/vendors/animate-css/animate.css">
<!-- main css -->
<link rel="stylesheet" href="home/css/style.css">
<link rel="stylesheet" href="home/css/responsive.css">
@endsection

@section("contents")
<!--================Contact Area =================-->
<section style="padding-top:120px" class="contact_area p_120">
    <div class="container">
        <div class="main_title">
            <h2>contact me</h2>
            <p>Contact me for Quick and Professional Solutions!</p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>{{ $user->province }}, {{ $user->country }}</h6>
                        <p>{{ $user->district }}, {{ $user->regency }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <!-- <h6><a href="#">{{ $user->phone }}</a></h6> -->
                        <h6><a href="http://wa.me/6285325556514">+62 853 2555 6514</a></h6>
                        <p>You can contact me 24/7</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <h6 onclick="copyText()" style="cursor: pointer;" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="copy" id="textToCopy">
                            {{ $user->email }}
                        </h6>
                        <p>Send me your ask anytime!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('create-message') }}" class="row" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="mt-10">
                            <input id="inputOnFocus" type="text" name="name" placeholder="Enter your name"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                class="single-input" value="{{ old('name') }}">
                            @if($errors->first('name'))
                            <label for="name" class="text-danger">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="mt-10">
                            <input type="text" name="email" placeholder="Enter email address"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                class="single-input" value="{{ old('email') }}">
                            @if($errors->first('email'))
                            <label for="email" class="text-danger">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <div class="mt-10">
                            <input id="inputSubject" type="text" name="subject" placeholder="Enter subject"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'"
                                class="single-input" value="{{ old('subject') }}">
                            @if($errors->first('subject'))
                            <label for="subject" class="text-danger">{{ $errors->first('subject') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mt-10">
                            <textarea name="message" class="single-textarea" placeholder="Enter message"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter message'"
                                value="{{ old('message') }}"></textarea>
                            @if($errors->first('message'))
                            <label for="message" class="text-danger">{{ $errors->first('message') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-right mt-10">
                        <button type="submit" value="submit" id="buttonSubmit" class="btn submit_btn"
                            style="display: inline-block;" onclick="formOnSubmit()">
                            Send Message
                        </button>
                        <button type="button" id="buttonLoading" class="btn submit_btn" style="display: none;" disabled>
                            Loading...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->
@endsection
@section('etc')

<!--================Contact Success and Error message Area =================-->
<div id="success" class="modal modal-message fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
                <h2>Thank you 😁</h2>
                <p>Your message is successfully sent...</p>
                <p class="text-secondary">Your message will be immediately seen by our team, a response will be sent via
                    email</p>
            </div>
        </div>
    </div>
</div>

<!-- Modals error -->
<div id="error" class="modal modal-message fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
                <h2 class="text-danger">Sorry !</h2>
                <div id="message-error" class="text-danger"></div>
            </div>
        </div>
    </div>
</div>
<!--================End Contact Success and Error message Area =================-->



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
<!-- contact js -->
<script src="home/js/jquery.form.js"></script>
<!-- <script src="home/js/jquery.validate.min.js"></script> -->
<script src="home/js/contact.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="home/js/gmaps.min.js"></script>
<script src="home/js/theme.js"></script>
<script>
    function formOnSubmit() {
        $('.single-textarea').attr('disabled', false)
        $('#inputSubject').attr('disabled', false)
        document.getElementById('buttonSubmit').style.display = "none";
        document.getElementById('buttonLoading').style.display = "inline-block";
    }
    function copyText() {
        const textToCopy = document.getElementById('textToCopy').innerText;

        const textarea = document.createElement('textarea');
        textarea.value = textToCopy;
        document.body.appendChild(textarea);

        textarea.select();
        document.execCommand('copy');

        document.body.removeChild(textarea);
    }
</script>
@if($errors->any())
<script>
    var errorMessages = [
        @foreach($errors -> all() as $error)
            "▪ {{ $error }}",
        @endforeach
    ];
    var errorMessage = errorMessages.join('<br>');
    $('#message-error').html(errorMessage);

    var error = new bootstrap.Modal(document.getElementById('error'), {
        keyboard: false
    })
    error.show()
</script>
@endif

@if(session('status'))
<script>
    var success = new bootstrap.Modal(document.getElementById('success'), {
        keyboard: false
    })
    success.show()
</script>
@endif
@if($messageOrder)
<script>
    var messageOrder = '{!! $messageOrder !!}'
    var subjectOrder = '{!! $subjectOrder !!}'
    $('.single-textarea').attr('disabled', true)
    $('#inputSubject').attr('disabled', true)
    $('.single-textarea').val(messageOrder)
    $('#inputSubject').val(subjectOrder)
    $('#inputOnFocus').focus()
</script>
@endif
@endsection