<?php


namespace Kosinski\Anonymizer\Providers;


use Kosinski\Anonymizer\Exceptions\InvalidProviderException;
use Kosinski\Anonymizer\Exceptions\ProviderClassNotExistsException;
use Kosinski\Anonymizer\Exceptions\ProviderExistsException;
use Kosinski\Anonymizer\Exceptions\ProviderNotExistsException;

class ProvidersManager
{

    protected $providers;

    public function __construct()
    {
        $this->providers = array();
    }

    public function getProviders(): array {
        return $this->providers;
    }
    public function hasProvider($name) {
        return array_key_exists($name, $this->getProviders());
    }

    public function getProvider($name) {
        if(!$this->hasProvider($name)) {
            throw new ProviderNotExistsException();
        }

        return $this->getProviders()[$name];
    }

    public function addProvider(string $name, string $class) {

        if($this->hasProvider($name)) {
            throw new ProviderExistsException();
        }

        if(!class_exists($class)) {
            throw new ProviderClassNotExistsException("Class $class is invalid");
        }

        $provider = new $class();

        if(!$provider instanceof Provider) {
            throw new InvalidProviderException();
        }


        $this->providers[$name] = $provider;
    }
}