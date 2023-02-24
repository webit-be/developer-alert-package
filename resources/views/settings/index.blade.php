<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Developer alert settings</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    {{-- Highlight JS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/languages/go.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/styles/vs2015.min.css">

    <style>
        * {
            font-family: 'Nunito' !important;
            color: #262626;
        }
        .btn-primary {
            background-color: #2EBFF3;
            border: none;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0B90C1 !important;
            border: none;
        }
        .bg-secondary {
            background: rgba(0, 0, 0, 0.05) !important;
        }
        form, .details {
            border: 1px solid lightgrey;
            display:block;
            border-radius: 5px;
        }
        .message {
            display:flex;
            justify-content: flex-start;
            padding: 10px;
            background: #D4EDDA;
            border-radius: 5px;
        }
        .message>span {
            margin-left:5px;
        }
        fieldset {
            border: none;
        }
        label {
            font-weight: bold;
        }
        input, select {
            padding: 5px 20px;
            margin-top: 10px;
        }
        h2, h1 {
            font-weight: bold;
        }
        #collapse-stack-trace {
            color: #262626;
        }
        hr {
            color: rgba(0, 0, 0, 0.6);
        }
        label, .btn {
            font-size: 1.2rem;
        }
        pre, code {
            border-radius: .5rem;
        }
    </style>
</head>
<body>
    <header class="mb-5 p-4 bg-light shadow-sm">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="logo fw-bold fs-5">
                <a href="/developer-alert/dashboard" style="text-decoration: none;color:#262626;">
                    Webit Developer Alert
                </a>
            </div>
            <a class="btn btn-primary btn-lg" style="height: max-content;" href="/developer-alert/dashboard">Go to dashboard</a>
        </div>
    </header>

    <div class="container mb-5">
        <h1>Settings for alert {{ $alert->id }}</h1>
    </div>

    <main class="container-md d-flex flex-column min-vh-100" style="gap: 4rem;">
        <div>
            <form class="d-flex flex-column gap-5 flex-md-row justify-content-between align-items-start p-4" action="{{ route('alert.update', $alert->id) }}" method="post">
                @csrf
    
                @if(session()->has('message'))
                    <div class="message">
                        <span>{{ session()->get('message') }}</span>
                    </div>
                @endif
    
                <fieldset>
                    <label for="">
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
            
            <div class="details p-4 mb-5">
                <h2 class="fs-4 mb-4">Details for alert {{ $alert->id }}</h2>

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
                        <i id="collapse-icon" class="bi bi-chevron-bar-expand ms-2"></i>
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

    <footer class="p-4 d-flex justify-content-center w-100" style="background:#BDE6FA;">
        <p>You reached the bottom 🤓</p>
    </footer>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Change icon when expanding an d collapsing -->
    <script>
        const collapseIcon = document.querySelector('#collapse-stack-trace');
        const icon = document.querySelector('#collapse-icon');

        // Configure code highlight for stack trace
        hljs.configure({
            languages: ['json'],
        });
        hljs.initHighlightingOnLoad();

        collapseIcon.addEventListener('click', () => {
            if (icon.classList.contains('bi-chevron-bar-expand')) {
                icon.classList.remove('bi-chevron-bar-expand');
                icon.classList.add('bi-chevron-bar-contract');
            } else {
                icon.classList.remove('bi-chevron-bar-contract');
                icon.classList.add('bi-chevron-bar-expand');
            }
        });
    </script>
</body>
</html>