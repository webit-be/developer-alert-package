    @extends('developer_alert::layouts.developerAlert')

    @section('content')

    <div class="container-md d-flex justify-content-between align-items-center mb-5 px-4" style="padding: 1em 0 3em 0;">
        <div class="position-relative">
            <h1 id="webit-title">Settings for alert {{ $alert->id }}</h1>
        </div>
    </div>

    <main class="container-md d-flex flex-column min-vh-100" style="gap: 4rem;">
        <div class="bg-light">
            <form class="d-flex flex-column gap-5 flex-md-row justify-content-between align-items-start p-4" action="{{ route('alert.update', $alert->id) }}" method="post">
                @csrf
    
                @if(session()->has('message'))
                    <div class="message">
                        <span>{{ session()->get('message') }}</span>
                    </div>
                @endif
    
                <fieldset>
                    <label for="">
                        <i class="fa fa-solid fa-bell"></i>
                        Snooze mail alert for
                        <br>
                        <input type="number" min="1" name="snooze_until" placeholder="hours">
                    </label>
                </fieldset>
                
                <fieldset>
                    <label for="">
                        Disable mail alert permanently
                        <br>
                        <select name="disable">
                            <option value="1" {{ $alert->is_disabled ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ ! $alert->is_disabled ? 'selected' : '' }}>No</option>
                        </select>
                    </label>
                </fieldset>
    
                @if ($alert->snoozed_until)
                    <fieldset>
                        <label for="">
                            Reset snooze (snoozed until {{ Carbon\Carbon::parse($alert->snoozed_until)->format('d/m/Y H:s') }})
                            <br>
                            <input type="checkbox" name="reset_snooze" value="1">
                        </label>
                    </fieldset>
                @endif
    
                <fieldset class="align-self-start align-self-md-center">
                    <button class="btn btn-primary" type="submit">Update</button>
                </fieldset>
            </form>
        </div>
    
        <div>
            
            <div class="details p-4 mb-5 bg-light">
                <div class="d-flex justify-content-between">
                    <h2 class="fs-4 mb-4">Details for alert {{ $alert->id }}</h2>
                    @if ( $alert->status === "Open" )
                        <span class="status btn btn-danger">{{ $alert->status }}</span>
                    @else
                        <span class="status btn btn-success">{{ $alert->status }}</span>
                    @endif
                </div>

                <hr>

                <label for="">
                    Message
                </label>
                <p>{{ $alert->error_message }}</p>
    
                <hr>
    
                <label for="">
                    From
                </label>
                <p>{{ $alert->function }} line {{ $alert->where_from }}</p>
    
                <hr>
    
                <label for="">
                    Times throwed
                </label>
                <p>{{ $alert->times_throwed }}</p>
    
                <hr>
    
                <label for="">
                    Throw logs
                </label>
                <p>{{ $alert->times_throwed }}</p>
    
                <hr>
    
                {{-- <label for="">
                    Stack trace
                </label>
                <p>{{ $alert->stack_trace }}</p> --}}

                <label for="" class="w-100">
                    <a id="collapse-stack-trace" class="w-100 text-decoration-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Stack trace
                        <i id="collapse-icon" class="ms-2"></i>
                    </a>
                </label>
                <div class="collapse mt-2" id="collapseExample">
                    <pre>
                        <code class="language-json" style="color: #262626;">
                            {{ $alert->stack_trace }}
                        </code>
                    </pre>
                </div>
            </div>
        </div>
    </main>

    <!-- Change icon when expanding an d collapsing -->
    <script>
        // Configure code highlight for stack trace
        hljs.configure({
            languages: ['json'],
        });
        hljs.initHighlightingOnLoad();
    </script>

@endsection