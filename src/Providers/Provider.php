<?php


namespace Kosinski\Anonymizer\Providers;


abstract class Provider
{
    abstract public function anonymize($toAnonymize);
}