@extends('developer_alert::layouts.developerAlert')

@section('content')

<div class="container-md mb-5">
    <h1>The following code causes the error</h1>
</div>

<div class="solving-wrapper container-md">
    <div class="error-causing-code">
        <span class="fw-bold">
            Path:
        </span>
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
        <form action="{{ route('alert.prompt', $alert->id) }}" method="POST" class="d-flex flex-column gap-4 bg-light p-4">
            @csrf
            <input type="hidden" id="alert-id" data-id="{{ $alert->id }}">

            <div class="form__choices d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input options" type="radio" name="prompt_type" value="replace" id="replace" aria-label="Checkbox for following text input" checked>
                    <label class="form-check-label" for="replace">
                        Ask for replace
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input options" type="radio" name="prompt_type" value="explanation" id="explanation" checked>
                    <label class="form-check-label" for="explanation">
                        Ask for explanation
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: max-content;">
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

        let option = null;

        // Check which checkbox is checked
        $('.options').each(function() {
            if ($(this).is(':checked')) {
                option = $(this).val()
            }
        })

        // Prompt for an answer

        $.ajax({
            url: '/developer-alert/alert/solve/prompt/' + id,
            type: 'GET',
            data: {
                option: option
            },
            success: function(response) {
                $('.answer-code').show()
                $('.answer-code').find('code').append(response)

                // highlight the new code
                hljs.highlightBlock($('.answer-code').find('code'));
            }
        });
    })
</script>
@endsection
