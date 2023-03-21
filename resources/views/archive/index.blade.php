@extends('developer_alert::layouts.developerAlert')

@section('content')

<div>
    <div class="container-md d-flex justify-content-between align-items-center mb-5 px-4" style="padding: 1em 0 3em 0;">
        <div class="position-relative">
            <h1 id="webit-title">Archive</h1>
        </div>
    </div>

    <div class="container-fluid" style="padding: 3em 1.5em 3em 1.5em;">
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
                        @forelse($archivedAlerts as $alert)
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
                                        <span class="status btn btn-danger">{{ $alert->status }}</span>
                                    @else
                                        <span class="status btn btn-success">{{ $alert->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('archive.restore', $alert->id) }}" class="button">
                                        Restore
                                        <i class="bi bi-arrow-repeat"></i>
                                    </a>
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
</div>



@endsection