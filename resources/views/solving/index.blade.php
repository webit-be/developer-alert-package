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

                <div class="d-flex justify-content-start">
                    <div class="col-3 px-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="background:transparent;border:none">
                                    <input type="radio" class="options" name="prompt_type" value="replace" aria-label="Checkbox for following text input" checked>
                                </div>
                            </div>
                            <span class="mx-2">Ask for replace</span>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="background:transparent;border:none">
                                    <input type="radio" class="options" name="prompt_type" value="explanation" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <span class="mx-2">Ask for explanation</span>
                        </div>
                    </div>
                </div>
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
