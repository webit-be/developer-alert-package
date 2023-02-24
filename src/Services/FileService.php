<?php

namespace webit_be\developer_alert\Services;

use Illuminate\Support\Facades\Log;

class FileService
{
    public static function fetchRelatedCode($where_from, $function)
    {
        // Fetches the code that causes the error

        try {
            $file_path = $where_from; // App\Http\Controllers\TestController

            if (file_exists($file_path)) {
                // Todo make the function line more robuust
                $content = file_get_contents($file_path);

                // Filter the function code itself out of the content by matching { } count
                $openBraceCount = 0;
                $closeBraceCount = 0;
                $inFunction = false;
                $lines = explode("\n", $content);
                $code = '';

                foreach ($lines as $line) {
                    if (strpos($line, $function . "()") !== false) {
                        $inFunction = true;
                    }
                    if ($inFunction) {
                        $code .= $line . "\n";
                        $openBraceCount += substr_count($line, '{');
                        $closeBraceCount += substr_count($line, '}');

                        if ($openBraceCount == $closeBraceCount) {
                            continue;
                        }
                    }
                }

                // Todo fetch also all related functions in case of references except Laravel core

                return $code;
            } else {
                dd("File not found");
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function replaceRelatedCode($old_code, $answer, $where_from)
    {
        // Todo if multiple answers, keep track of what has been attempted and what not
       
        $answer = $answer['choices'][0]['text'];
        $filePath = base_path() . '/' . str_replace('\\', '/', $where_from[0]['class']) . '.php';

        if (file_exists($filePath)) {
            $file = file_get_contents($filePath);
            $file = str_replace(trim($old_code,  "\n"), trim($answer,  "\n"), $file);
            file_put_contents($filePath, $file);
        } else {
            dd('stop');
        }

        Log::info('API answer: ');
        Log::info($answer);

        dd('Code changed in ' . $where_from[0]['class'] . '.php');
    }

    public static function replaceSlashes($path)
    {
        return str_replace('\\', '/', $path);
    }
}
