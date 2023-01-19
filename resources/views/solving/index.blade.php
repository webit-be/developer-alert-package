@extends('developer_alert::layouts.developerAlert')

@section('content')
<div class="solving-wrapper container">
    <h1 class="mb-5">The following code causes the error</h1>

    <div class="error-causing-code">
        <span>
            {{ $alert->where_from }}
        </span>
        <pre>
            <code class="php">
                {{ $code }}
            </code>
        </pre>
    </div>

    <div class="solving">
        <form action="{{ route('alert.prompt', $alert->id) }}" method="POST">
            @csrf
            <input type="hidden" id="alert-id" data-id="{{ $alert->id }}">
            <button type="submit" class="btn btn-success">
                Prompt to openAI
            </button>
        </form>
    </div>

    <div class="answer-code" style="display:none">
        <pre>
            <code class="php">
                
            </code>
        </pre>
    </div>
</div>

<script>
    hljs.configure({
        languages: ['php']
    });
    hljs.initHighlightingOnLoad();

    $('.btn-success').click(function(e) {
        e.preventDefault()

        const id = $('#alert-id').data('id')

        // Prompt for an answer
        
        $.ajax({
            url: '/developer-alert/alert/solve/prompt/' + id,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                // The response is the HTML content
                $('.answer-code').show()
                $('.answer-code').find('code').append(response)
            }
        });
    })
        
</script>
@endsection