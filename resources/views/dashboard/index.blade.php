@extends('developer_alert::layouts.developerAlert')

@section('content')
<div class="dashboard-wrapper container-fluid">

    <div class="py-3">
        <h1>Dashboard</h1>

        <a href="{{ route('dashboard.download') }}" class="badge badge-info p-2">Download log file</a>
    </div>

    <div class="table-responsive">
        <table class="table">
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
                    <tr>
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
                            <span class="badge badge-danger p-2">Open</span>
                        </td>
                        <td>
                            <a href="{{ route('alert.settings', $alert->id) }}" class="badge badge-info p-2">Settings</a>
                            <a href="{{ route('alert.solve', $alert->id) }}" class="badge badge-info p-2">Solve</a>
                            <a href="{{ route('alert.solve', $alert->id) }}" class="badge badge-info p-2">Archive</a>
                            <a href="{{ route('alert.solve', $alert->id) }}" class="badge badge-info p-2">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection