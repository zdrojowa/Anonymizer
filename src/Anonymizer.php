<?php

namespace Kosinski\Anonymizer;

use Kosinski\Anonymizer\Providers\Email;
use Kosinski\Anonymizer\Providers\ProvidersManager;

/***
 * Class Anonymizer
 * @package Kosinski\Anonymizer
 * @method email($toAnonymize)
 */
class Anonymizer
{

    /**
     * @var array
     */
    protected $providers = array(
        "email" => Email::class,
    );

    /**
     * Anonymizer constructor.
     */
    public function __construct()
    {
        $this->providersManager = new ProvidersManager();

        $this->loadProviders();
    }

    /**
     * @throws Exceptions\InvalidProviderException
     * @throws Exceptions\ProviderClassNotExistsException
     * @throws Exceptions\ProviderExistsException
     */
    protected function loadProviders() {
        foreach ($this->providers as $key => $provider) {
            $this->getProvidersManager()->addProvider($key, $provider);
        }
    }

    /**
     * @return ProvidersManager
     */
    public function getProvidersManager(): ProvidersManager {
        return $this->providersManager;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @throws Exceptions\ProviderNotExistsException
     */
    public function __call($name, $arguments)
    {
        $name = strtolower($name);

        if(!$this->getProvidersManager()->hasProvider($name)) {
            echo "EEEEEEEEEEEEEEEROR";
            return;
        }

        return $this->getProvidersManager()->getProvider($name)->anonymize(...$arguments);
    }
}