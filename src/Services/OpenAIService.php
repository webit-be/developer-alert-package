<?php

namespace webit_be\developer_alert\Services;

class OpenAIService 
{

    public static function solveError($message, $where_from, $function, $replace_code = null, $option)
    {
        // Construct the instructions for the prompt first
        $error_causing_code = FileService::fetchRelatedCode($where_from, $function);

        if ($error_causing_code !== false) {

            // Build the prompt
            $prompt = OpenAIService::constructPrompt($message, $error_causing_code, $option);

            // Fetch the answer
            $answer = OpenAIService::prompt([], $prompt['post_data'], null, $prompt['endpoint']);

            if (! $replace_code) {
                return $answer;
            }

            // Iniate the solving process
            return FileService::replaceRelatedCode($error_causing_code, $answer, $where_from);
        }

        return false;
    }

    public static function constructPrompt($message, $code, $option)
    {
        // options = replace, explain
        if ($option == 'replace') {
            $post_data = [
                "prompt" => "#php Working in a Laravel environment. The code included code throws the following error message: '{$message}'. Provide the entire script function code that replaces the faulty code and solves the error it throws. The code is as follows: #php " . $code . ' If you suggest that the error fix belongs to another file of function, make this clear.',
                "model" => 'text-davinci-003'
            ];
        } else {
            $post_data = [
                "prompt" => "#php Laravel. The code is as follows: #php " . $code . ' Explain this error',
                "model" => 'text-davinci-003'
            ];
        }

        $endpoint = 'davinci/completions';
        
        return [
            'post_data' => $post_data,
            'endpoint' => $endpoint
        ];
    }

    public static function prompt($options, $post_data, $headers = null, $endpoint)
    {
        if (! $headers) {
            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer " . env('OPENAI_KEY')
            ];
        }

        $default_options = [
            "temperature" => 0.5,
            "max_tokens" => 2048,
            "stop" => "",
            "n" => 1
        ];

        $options = array_merge($default_options, $options);
        $post_data = array_merge($options, $post_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $response_data = json_decode($response, true);
        curl_close($ch);

        if (isset($response_data['error']) || ! isset($response_data['choices'][0]['text'])) {
            dd($response_data);
        }

        return $response_data;
    }
}