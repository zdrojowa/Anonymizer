<?php


namespace Kosinski\Anonymizer\Providers;


use Kosinski\Anonymizer\Helpers\Helper;

/**
 * Class Email
 * @package Kosinski\Anonymizer\Providers
 */
class Email extends Provider
{

    /**
     * @param $toAnonymize
     *
     * @return array|mixed|string
     */
    public function anonymize($toAnonymize)
    {
        if(is_string($toAnonymize)) {
            //return $this->starString($toAnonymize);
            return "XXX";
        }
        else if(is_array($toAnonymize)) {
            $this->starArray($toAnonymize);

            return $this->starArray($toAnonymize);
        }
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function starString(string $string): string {
        $stars = str_repeat('*', $this->randomLength(1, strlen($string)));

        return $string[0] . $stars . $string[strlen($string) - 1];
    }

    /**
     * @param $array
     *
     * @return array
     */
    public function starArray($array): array {
        foreach ($array as $index => $value) {

            if(is_array($value)) {
                $array[$index] = $this->starArray($value);
            }
            else if (is_string($value)) {
                $str = '';



                foreach (explode('@', $value) as $email_index => $part_of_email) {

                    if($email_index === 1) {
                        $str .= '@';

                        $str .= Helper::starString($part_of_email);
                    }
                    else {
                        $str .= Helper::starString($part_of_email);
                    }
                }

                $array[$index] = $str;
            }
        }

        return $array;
    }
}