<?php

namespace Kosinski\Anonymizer;

use Kosinski\Anonymizer\Providers\Email;
use Kosinski\Anonymizer\Providers\ProvidersManager;

class Anonymizer
{

    protected $providers = array(
        "email" => Email::class,
    );

    public function __construct()
    {
        $this->providersManager = new ProvidersManager();

        $this->loadProviders();
    }

    protected function loadProviders() {
        foreach ($this->providers as $key => $provider) {
            $this->getProvidersManager()->addProvider($key, $provider);
        }
    }

    public function getProvidersManager(): ProvidersManager {
        return $this->providersManager;
    }

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