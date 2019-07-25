<?php

namespace Kosinski\Anonymizer\Helpers;

class Helper
{

    public static function randomLength(int $from, int $to) {
        $random = random_int($from, $to + random_int(3, 15));

        if($random === $to) {
            return self::randomLength($from, $to);
        }

        return $random;
    }

    public static function starString(string $string): string {
        $starsCount = self::randomLength(2, strlen($string));
        $stars = str_repeat('*', $starsCount);

        if(strlen($string) > 4) {
            for($x = 0; $x < 2; $x++) {
                if($starsCount >= strlen($string)) {
                    $random = random_int(0, strlen($string) - 1);
                    $stars[$random] = $string[$random];
                }
                else if($starsCount < strlen($string)) {
                    $stars[0] = $string[0];
                    $x++;
                }
            }
        }


        return $stars;
    }
}