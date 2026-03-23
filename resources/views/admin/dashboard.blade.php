@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-2">
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="h4 font-weight-bolder">Dashboard</h3>
        </div>
    </div>

    <div class="row g-3"> <!-- g-3 untuk gap antar card -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">User login Today</p>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">person</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span>{{ $logToday }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Category Tools</p>

                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">person</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span>{{ $Totaluser }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Tools</p>

                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">co_present</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span>{{ $Totaluser2 }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Tools</p>

                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">domain</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span>{{ $Totalalat }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-5">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Log Activity table</h6>
                </div>
            </div>
            <div class="m-3 mb-2">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
            <div class="card-body px-3 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="siswa">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">user</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">activity</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activity as $log)
                            <tr>
                                <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $log->user->name }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $log->activity }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#siswa').DataTable();
    });
</script>

@endsection