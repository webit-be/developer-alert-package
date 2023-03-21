@extends('developer_alert::layouts.developerAlert')

@section('content')


    <div class="container-md d-flex justify-content-between align-items-center mb-5 px-4" style="padding: 1em 0 3em 0;">
        <div class="position-relative">
            <h1 id="webit-title">Dashboard</h1>
        </div>
        <a href="{{ route('dashboard.download') }}" class="button" style="height: max-content;">
            Download log file
            <i class="fa fa-solid fa-download"></i>
        </a>
    </div>

    <div class="stats container px-4 mb-5 d-flex justify-content-center align-items-center flex-wrap gap-2 justify-content-lg-start gap-lg-5">
        <div class="card bg-primary text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body">
                <p>Total Alerts</p>
                <span class="fs-2">
                    {{ $alerts->count() }}
                </span>
            </div>
        </div>
        <div class="card bg-danger text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body position-relative">
                <p>Open Alerts</p>
                <span class="fs-2">
                   {{ $alerts->where('status', 'Open')->where('deleted_at', null)->count() }}
                </span>
                <i class="bi bi-exclamation-square position-absolute opacity-25 bottom-0 end-0 mb-2 me-4 fs-2"></i>
            </div>
        </div>
        <div class="card bg-success text-white" style="width: 13rem; min-height: 6rem;">
            <div class="card-body position-relative">
                <p>Solved Alerts</p>
                <span class="fs-2">
                    {{ $alerts->where('status', 'Solved')->where('deleted_at', null)->count() }}
                </span>
                <i class="bi bi-check-square position-absolute opacity-25 bottom-0 end-0 mb-2 me-4 fs-2"></i>
            </div>
        </div>
        <div class="card text-white" style="background: gray; width: 13rem; min-height: 6rem;">
            <div class="card-body position-relative">
                <p>Archived Alerts</p>
                <span class="fs-2">
                    {{ $trashedAlerts->whereNotNull('deleted_at')->count() }}
                </span>
                <i class="bi bi-archive position-absolute opacity-25 bottom-0 end-0 mb-2 me-4 fs-2"></i>
            </div>
        </div>
    </div>

    <div id="dashboard-table" class="bg-light container-fluid" style="border-radius: 0px;">
        <div class="container">
            <div class="table-responsive">
                <table id="tableAlerts" class="table table-hover align-middle h-auto">
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
                    <tbody class="h-auto">
                        @forelse($alerts->where('deleted_at', null) as $alert)
                            <tr class="align-middle">
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
                                        <a href="{{ route('alert.update', $alert->id, $alert->status) }}" class="status btn btn-danger">{{ $alert->status }}</a>
                                    @else
                                        <a href="{{ route('alert.update', $alert->id, $alert->status) }}" class="status btn btn-success">{{ $alert->status }}</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" data-bs-toggle="dropdown" data-boundary="window" data-bs-boundary="window" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('alert.settings', $alert->id) }}">Settings</a></li>
                                            <li><a class="dropdown-item" href="{{ route('alert.solve', $alert->id) }}"">Solve</a></li>
                                            <li><a class="dropdown-item" href="{{ route('alert.archive', $alert->id) }}">Archive</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted">0</td>
                                <td colspan="8" class="text-center text-muted">No alerts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection