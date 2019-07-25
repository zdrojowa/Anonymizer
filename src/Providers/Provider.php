<?php


namespace Kosinski\Anonymizer\Providers;

/**
 * Class Provider
 * @package Kosinski\Anonymizer\Providers
 */
abstract class Provider
{
    /**
     * @param $toAnonymize
     *
     * @return mixed
     */
    abstract public function anonymize($toAnonymize);
}