<?php


namespace Kosinski\Anonymizer\Providers;


class Email extends Provider
{

    public function anonymize($toAnonymize)
    {
        if(is_string($toAnonymize)) {
            return $this->starString($toAnonymize);
        }
        else if(is_array($toAnonymize)) {
            $toAnonymize = $toAnonymize;

            foreach ($toAnonymize as $index => $value) {
                $toAnonymize[$index] = $this->starString($value);
            }

            return $toAnonymize;
        }
    }

    public function randomLength(int $from, int $to) {
        $random = random_int($from, $to + random_int(1, 5));

        if($random === $to - 2) {
            return $this->randomLength($from, $to);
        }

        return $random;
    }

    public function starString(string $string): string {
        $stars = str_repeat('*', $this->randomLength(1, strlen($string)));

        return $string[0] . $stars . $string[strlen($string) - 1];
    }
}