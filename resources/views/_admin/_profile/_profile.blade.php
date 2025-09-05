@extends("_admin._layouts._layout")

@section("isDashboard", "active")
@section("title", "Dashboard")
@section("styles")
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="../_admin/css/nucleo-icons.css" rel="stylesheet" />
<link href="../_admin/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="../_admin/css/nucleo-svg.css" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="../_admin/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section("contents")
<div id="loading-overlay" class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
</div>
<section>
    <div class="container py-5">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $user->photo }}" alt="avatar" class="rounded-circle img-fluid"
                            style="width: 150px;">
                        <h5 class="my-3">{{ $user->name }}</h5>
                        <p class="text-muted mb-1">Full Stack Developer</p>
                        <p class="text-muted mb-4">
                            {{ $user->district }},
                            {{ $user->regency }},
                            {{ $user->province }},
                            {{ $user->country }}
                        </p>
                        <div class="d-flex justify-content-center mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#editProfileModal" type="button"
                                class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <p class="mb-0">Social Media</p>
                                <div>
                                    <button type="button" class="btn btn-sm btn-primary mb-0 me-1"
                                        data-bs-toggle="modal" data-bs-target="#createSocialModal"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </li>
                            @foreach($social as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-{{$item->name}} fa-lg"></i>
                                <p class="mb-0  text-secondary text-xs">
                                    <a href="{{ $item->link }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="{{ $item->link }}">
                                        {{ $item->name }}
                                    </a>
                                </p>
                                <i class="fas fa-edit" type="button" data-bs-toggle="modal"
                                    data-bs-target="#editSocialModal" onclick="editSocialModal('{{$item->id}}')"></i>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ $user->district }},
                                    {{ $user->regency }},
                                    {{ $user->province }},
                                    {{ $user->country }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tagline</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" style="text-align: justify;">{{ $user->tagline }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Description</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" style="text-align: justify;">{{ $user->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Edit-->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update-profile', $user->id) }}" method="post" enctype="multipart/form-data"
                id="formEdit" onsubmit="formOnSubmit()">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input name="photo" class="form-control" type="file" id="photoEdit">
                        <img src="{{ $user->photo }}" id="photoEditView" class="mt-2">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ $user->name }}" name="name" type="text" class="form-control" id="nameEdit"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input value="{{ $user->phone }}" name="phone" type="text" class="form-control" id="phoneEdit"
                            placeholder="Input Phone">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="{{ $user->email }}" name="email" type="email" class="form-control" id="emailEdit"
                            placeholder="Input Email">
                    </div>
                    <div class="mb-3">
                        <label for="tagline" class="form-label">Tagline</label>
                        <textarea name="tagline" class="form-control" id="taglineEdit" rows="3"
                            placeholder="Input Tagline">{{ $user->tagline }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="descriptionEdit" rows="3"
                            placeholder="Input Description">{{ $user->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <input value="{{ $user->district }}" name="district" type="text" class="form-control"
                            id="districtEdit" placeholder="Input District">
                    </div>
                    <div class="mb-3">
                        <label for="regency" class="form-label">Regency</label>
                        <input value="{{ $user->regency }}" name="regency" type="text" class="form-control"
                            id="regencyEdit" placeholder="Input Regency">
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input value="{{ $user->province }}" name="province" type="text" class="form-control"
                            id="provinceEdit" placeholder="Input Province">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input value="{{ $user->country }}" name="country" type="text" class="form-control"
                            id="countryEdit" placeholder="Input Country">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary buttonSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="createSocialModal" tabindex="-1" aria-labelledby="createSocialModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('create-social') }}" method="post" onsubmit="formOnSubmitSocial()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSocialModalLabel">Create Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Input name">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input name="link" type="text" class="form-control" id="link" placeholder="Input link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary buttonSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editSocialModal" tabindex="-1" aria-labelledby="editSocialModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formEdit" onsubmit="formOnSubmit()">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSocialModalLabel">Edit Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="nameSocialEdit"
                            placeholder="Loading...">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input name="link" type="text" class="form-control" id="linkEdit" placeholder="Loading...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary buttonSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!--   Core JS Files   -->
<script src="../_admin/js/core/popper.min.js"></script>
<script src="../_admin/js/core/bootstrap.min.js"></script>
<script src="../_admin/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../_admin/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../_admin/js/argon-dashboard.min.js?v=2.0.4"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showLoading() {
        document.getElementById('loading-overlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loading-overlay').style.display = 'none';
    }
</script>
<script>
    $(document).ready(function () {
        hideLoading()
    });
    function formOnSubmit() {
        $('.buttonSubmit').html('Loading...');
        $('.buttonSubmit').attr('disabled', true);
        $('.buttonClose').css('display', 'none');
        showLoading()
    }
</script>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggleIcon.classList.remove('fa-eye');
            passwordToggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggleIcon.classList.remove('fa-eye-slash');
            passwordToggleIcon.classList.add('fa-eye');
        }
    }
</script>
<script>

    function editSocialModal(id) {
        $('.buttonSubmit').html('Loading...');
        $('.buttonSubmit').attr('disabled', true);
        $('.buttonClose').css('display', 'none');

        $('#formEdit').attr('action', '');
        $('#nameSocialEdit').val(null);
        $('#linkEdit').val(null);

        $('#nameSocialEdit').prop('disabled', true);
        $('#linkEdit').prop('disabled', true);
        showLoading();

        id = parseInt(id)

        $.ajax({
            url: '{{ route("social-by-id",["id" => ":id"]) }}'.replace(':id', id),
            type: 'GET',
            success: function (response) {
                $('.buttonSubmit').html('Save');
                $('.buttonSubmit').attr('disabled', false);
                $('.buttonClose').css('display', 'block');

                $('#nameSocialEdit').prop('disabled', false);
                $('#linkEdit').prop('disabled', false);

                $('#formEdit').attr('action', '{{ route("update-social", ["id" => ":id"]) }}'.replace(":id", id));
                $('#nameSocialEdit').val(response.name);
                $('#linkEdit').val(response.link);
                hideLoading();
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
@endsection