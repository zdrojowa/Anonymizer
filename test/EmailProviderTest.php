<?php


class EmailProviderTest extends \PHPUnit\Framework\TestCase
{

    protected function setUp(): void
    {
        $this->provider = new \Kosinski\Anonymizer\Providers\Email();
    }

    public function testAnonymizedStringLength() {
        $email = 'test@test.pl';

        $this->assertFalse(strlen($this->provider->anonymize($email)) === strlen($email));
        $this->assertTrue(strlen($this->provider->anonymize($email)) !== strlen($email));
    }
}