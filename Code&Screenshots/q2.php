<?php

function lineSum(string $filename, int $lineNumber): int
{
    if (!is_readable($filename)) {
        return 0;
    }

    $handle = fopen($filename, 'r');
    if (!$handle) {
        return 0;
    }
    $current = 0;
    $sum = 0;

    while (($line = fgets($handle)) !== false) {
        $current++;
        $trimmed = trim($line);
        if ($trimmed === '' || str_starts_with($trimmed, '#')) {
            continue;
        }
        if ($current === $lineNumber) {

            $tokens = preg_split('/\s+/', $trimmed);

            foreach ($tokens as $token) {

                if (preg_match('/^-?\d+$/', $token)) {
                    $sum += (int)$token;
                }
            }

            fclose($handle);
            return $sum;
        }
    }
    fclose($handle);
    return 0;
}

