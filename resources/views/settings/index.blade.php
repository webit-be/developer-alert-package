<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Developer alert settings</title>

    <style>
        * {
            font-family: 'Roboto' !important;
        }
        body {
            width: 1200px;
            margin: auto;
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
        button {
            background: black;
            border: none;
            color: white;
            padding: 7.5px 20px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        input, select {
            padding: 5px 20px;
            margin-top: 10px;
        }
        h2 {
            text-transform: uppercase
        }
        .details {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Settings for alert {{ $alert->id }}</h2>

        <form action="{{ route('alert.update', $alert->id) }}" method="post">
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

            <fieldset>
                <button type="submit">Update</button>
            </fieldset>
        </form>
    </div>

    <div>
        <h2>Details for alert {{ $alert->id }}</h2>

        <div class="details">
            <label for="">
                Message
            </label>
            <p>{{ $alert->error_message }}</p>

            <hr>

            <label for="">
                From
            </label>
            <p>{{ $alert->file }}.php line {{ $alert->where_from }}</p>

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

            <label for="">
                Stack trace
            </label>
            <p>{{ $alert->stack_trace }}</p>
        </div>
    </div>
</body>
</html>