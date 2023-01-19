<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Error Alert</title>
</head>

<body bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
    <table width="650" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="background-color:#ffffff;width:650px;">
        <div>
            <h1 style="color:red"><span>{{ env('APP_URL') }}</span> error alert</h1>
        </div>

        <div>
            <strong>Message:</strong>   

            <p>
                {{ $alert->error_message }}
            </p>
        </div>
        <div>
            <strong>Coming from:</strong> 

            <p>
                <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a>                 
            </p>

            <p>
                File: {{ $alert->where_from }}
            </p>
            
            <p>
                Function: {{ $alert->function }}
            </p>
        </div>

        <div>
            <strong>Settings</strong> 

            <p>
                <a href="{{ $snooze_url }}">Go to the settings page</a>
            </p>
        </div>

        <div>
            <strong>Stack trace</strong>   

            <p>
                {{-- Stack trace data comes in array --}}
                {{ var_dump(json_decode($alert->stack_trace)) }}
            </p>
        </div>
    </table>
</body>

</html>
