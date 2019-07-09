<?php

use Kosinski\Anonymizer\Exceptions\InvalidProviderException;
use \PHPUnit\Framework\TestCase;
use \Kosinski\Anonymizer\Providers\ProvidersManager;
use \Kosinski\Anonymizer\Providers\Email;
use \Kosinski\Anonymizer\Exceptions\ProviderExistsException;
use \Kosinski\Anonymizer\Exceptions\ProviderClassNotExistsException;
use \Kosinski\Anonymizer\Exceptions\ProviderNotExistsException;
use \Kosinski\Anonymizer\Providers\Provider;

final class ProviderManagerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->providersManager = new ProvidersManager();
        $this->providersManager->addProvider("email", Email::class);
    }

    public function testManagerHasProvider() {
        $this->assertTrue($this->providersManager->hasProvider("email"));
        $this->assertFalse($this->providersManager->hasProvider("dupa"));
    }

    public function testProviderExistsException() {
        $this->expectException(ProviderExistsException::class);

        $this->providersManager->addProvider("email", Email::class);
    }

    public function testProviderClassNotExistsException() {
        $this->expectException(ProviderClassNotExistsException::class);

        $this->providersManager->addProvider("dupa", Dupa::class);
    }

    public function testInvalidProviderException() {
        $this->expectException(InvalidProviderException::class);

        $this->providersManager->addProvider("dupa", stdClass::class);
    }

    public function testProviderNotExistsException() {
        $this->expectException(ProviderNotExistsException::class);

        $this->providersManager->getProvider("dupa");
    }

    public function testGetProvider() {
        $this->assertInstanceOf(Provider::class, $this->providersManager->getProvider("email"));
    }
}