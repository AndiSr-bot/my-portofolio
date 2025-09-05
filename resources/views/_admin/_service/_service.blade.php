@extends("_admin._layouts._layout")

@section("isService", "active")
@section("title", "Service")
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
<div class="container-fluid py-4">
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
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-8">
                            <h6>Services table</h6>
                        </div>
                        <div class="col-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createServiceModal">
                                Create service
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th class="text-secondary text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @if($service->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center text-xs font-weight-bold py-4">No data found</td>
                                </tr>
                                @endif
                                @foreach($service as $item)
                                <tr>
                                    <td class="px-4">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $i++ }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $item->name }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-secondary text-wrap text-xs font-weight-bold">
                                            {{ $item->description }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <a href="javascript:;" class="text-warning text-xs font-weight-bold"
                                            data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                            data-bs-target="#editServiceModal" data-id="{{$item->id}}"
                                            onclick="editServiceModal('{{$item->id}}')">
                                            Edit
                                        </a>
                                        <a href="javascript:;" class="text-xs font-weight-bold text-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create-->
<div class="modal fade" id="createServiceModal" tabindex="-1"
    aria-labelledby="createServiceModalLabel data-bs-backdrop=" static"" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('create-service') }}" method="post" onsubmit="formOnSubmit()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createServiceModalLabel">Create Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Input name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3"
                            placeholder="Input description"></textarea>
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
<!-- Modal Edit-->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formEdit" onsubmit="formOnSubmit()">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="nameEdit" placeholder="Loading...">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="descriptionEdit" rows="3"
                            placeholder="Loading..."></textarea>
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
        showLoading();
    }
    function editServiceModal(id) {
        $('.buttonSubmit').html('Loading...');
        $('.buttonSubmit').attr('disabled', true);
        $('.buttonClose').css('display', 'none');

        $('#formEdit').attr('action', '');
        $('#nameEdit').val(null);
        $('#descriptionEdit').val(null);

        $('#nameEdit').prop('disabled', true);
        $('#descriptionEdit').prop('disabled', true);
        showLoading();

        id = parseInt(id)

        $.ajax({
            url: '{{ route("service-by-id",["id" => ":id"]) }}'.replace(':id', id),
            type: 'GET',
            success: function (response) {
                $('.buttonSubmit').html('Save');
                $('.buttonSubmit').attr('disabled', false);
                $('.buttonClose').css('display', 'block');

                $('#nameEdit').prop('disabled', false);
                $('#descriptionEdit').prop('disabled', false);

                $('#formEdit').attr('action', '{{ route("update-service", ["id" => ":id"]) }}'.replace(":id", id));
                $('#nameEdit').val(response.name);
                $('#descriptionEdit').val(response.description);
                hideLoading();
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
@endsection