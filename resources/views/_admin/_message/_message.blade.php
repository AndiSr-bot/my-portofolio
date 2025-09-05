@extends("_admin._layouts._layout")

@section("isMessage", "active")
@section("title", "Message")
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
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Message table</h6>
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
                                        Email
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Subject
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Message
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
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
                                @if($message->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center text-xs font-weight-bold py-4">No data found</td>
                                </tr>
                                @endif
                                @foreach($message as $item)
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
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $item->email }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-secondary text-wrap text-xs font-weight-bold">
                                            {{ $item->subject }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <span class="text-secondary text-wrap text-xs text-justify font-weight-bold">
                                            {!! $item->message !!}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        @if($item->isRead)
                                        <span class="badge bg-success text-white text-lowercase"
                                            style="width: 70px;max-height: 20px; padding: 4px; font-size: 8px;">
                                            read
                                        </span>
                                        @else
                                        <span class="badge bg-danger text-white text-lowercase"
                                            style="width: 70px;max-height: 20px; padding: 4px; font-size: 8px;">
                                            unread
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4">
                                        <a href="javascript:;" class="text-info text-xs font-weight-bold"
                                            data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                            data-bs-target="#detailMessageModal"
                                            onclick="viewMessageModal('{{$item->id}}')">
                                            Detail
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
<div class="modal fade" id="detailMessageModal" tabindex="-1" aria-labelledby="detailMessageModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
        <div class=" modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body px-0 pt-2">

            <table class="col-12">
                <tr>
                    <td class="col-2">
                        <p class="ps-3 mb-2 text-xs">Name</p>
                    </td>
                    <td style="width: 10px;">
                        <p class="mb-2 text-xs">:</p>
                    </td>
                    <td>
                        <p class="mb-2 text-capitalize text-xs" id="messageName">...</p>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">
                        <p class="ps-3 mb-2 text-xs">Email</p>
                    </td>
                    <td style="width: 10px;">
                        <p class="mb-2 text-xs">:</p>
                    </td>
                    <td>
                        <p class="mb-2 text-xs" id="messageEmail">...</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr class="mt-0 mb-2"
                            style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4));">
                    </td>
                </tr>
                <tr>
                    <td class="col-2">
                        <p class="ps-3 mb-2 text-xs">Subject </p>
                    </td>
                    <td style="width: 10px;">
                        <p class="mb-2 text-xs">:</p>
                    </td>
                    <td>
                        <p class="mb-2 text-capitalize text-xs" id="messageSubject">...</p>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">
                        <p class="ps-3 mb-2 text-xs">Message </p>
                    </td>
                    <td style="width: 10px;">
                        <p class="mb-2 text-xs">:</p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="px-3 mb-2 text-xs text-secondary" id="messageMessage">
                            ...
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <a href="{{ route('message') }}" class="btn btn-info mb-0">Oke</a>
        </div>

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
    function viewMessageModal(id) {
        $('#messageName').html('...');
        $('#messageEmail').html('...');
        $('#messageSubject').html('...');
        $('#messageMessage').html('...');
        showLoading();
        id = parseInt(id)
        $.ajax({
            url: '{{ route("message-by-id",["id" => ":id"]) }}'.replace(':id', id),
            type: 'GET',
            success: function (response) {
                $('#messageName').html(response.name);
                $('#messageEmail').html(response.email);
                $('#messageSubject').html(response.subject);
                $('#messageMessage').html(response.message);
                hideLoading();
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
@endsection