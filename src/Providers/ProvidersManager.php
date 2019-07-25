<?php


namespace Kosinski\Anonymizer\Providers;


use Kosinski\Anonymizer\Exceptions\InvalidProviderException;
use Kosinski\Anonymizer\Exceptions\ProviderClassNotExistsException;
use Kosinski\Anonymizer\Exceptions\ProviderExistsException;
use Kosinski\Anonymizer\Exceptions\ProviderNotExistsException;

/**
 * Class ProvidersManager
 * @package Kosinski\Anonymizer\Providers
 */
class ProvidersManager
{

    /**
     * @var array
     */
    protected $providers;

    /**
     * ProvidersManager constructor.
     */
    public function __construct()
    {
        $this->providers = array();
    }

    /**
     * @return array
     */
    public function getProviders(): array {
        return $this->providers;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasProvider($name) {
        return array_key_exists($name, $this->getProviders());
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws ProviderNotExistsException
     */
    public function getProvider($name) {
        if(!$this->hasProvider($name)) {
            throw new ProviderNotExistsException();
        }

        return $this->getProviders()[$name];
    }

    /**
     * @param string $name
     * @param string $class
     *
     * @throws InvalidProviderException
     * @throws ProviderClassNotExistsException
     * @throws ProviderExistsException
     */
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