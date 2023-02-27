@extends('developer_alert::layouts.developerAlert')

@section('content')

<style>
    .table-responsive, table, tr {
        overflow: visible !important;
    }
    .card {
        background-color: #BDE6FA;
        border: none; 
        /* border-radius: .5rem; */
    }
</style>

<div class="mx-4">
    <div class="container-md d-flex justify-content-between align-items-center mb-5">
        <h1>Dashboard</h1>
        <a href="{{ route('dashboard.download') }}" class="btn btn-lg btn-primary p-2" style="height: max-content;">Download log file</a>
    </div>

    <div class="stats container mb-5 d-flex justify-content-center align-items-center flex-wrap gap-2 justify-content-lg-start gap-lg-5">
        <div class="card bg-primary text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body">
                <p># Total Alerts</p>
                <span class="fs-2">
                    {{ $alerts->count() }}
                </span>
            </div>
        </div>
        <div class="card bg-danger text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body position-relative">
                <p># Open Alerts</p>
                <span class="fs-2">
                   {{ $alerts->where('status', 'Open')->count() }}
                </span>
                <i class="bi bi-exclamation-square position-absolute opacity-25 bottom-0 end-0 mb-2 me-4 fs-2"></i>
            </div>
        </div>
        <div class="card bg-success text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body position-relative">
                <p># Solved Alerts</p>
                <span class="fs-2">
                    {{ $alerts->where('status', 'Closed')->count() }}
                </span>
                <i class="bi bi-check-square position-absolute opacity-25 bottom-0 end-0 mb-2 me-4 fs-2"></i>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="tableAlerts" class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Error message</th>
                    <th scope="col">File</th>
                    <th scope="col">Path</th>
                    <th scope="col">Function</th>
                    <th scope="col">Throws</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alerts as $alert)
                    <tr class="align-middle" style="height: 100%;">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $alert->error_message }}</td>
                        <td>
                            @php
                                $filename = explode('/', $alert->where_from);
                            @endphp
                            
                            {{ $filename[count($filename)-1] }}
                        </td>
                        <td>{{ $alert->where_from }}</td>
                        <td>{{ $alert->function }}</td>
                        <td>{{ $alert->times_throwed }}</td>
                        <td>
                            @if ( $alert->status === "Open" )
                                <span class="status btn btn-danger">{{ $alert->status }}</span>
                            @else
                                <span class="status btn btn-success">{{ $alert->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" data-bs-toggle="dropdown" data-boundary="window" data-bs-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('alert.settings', $alert->id) }}">Settings</a></li>
                                    <li><a class="dropdown-item" href="{{ route('alert.solve', $alert->id) }}">Solve</a></li>
                                    <li><a class="dropdown-item" href="{{ route('alert.solve', $alert->id) }}">Archive</a></li>
                                    <li><a class="dropdown-item" href="{{ route('alert.solve', $alert->id) }}">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection