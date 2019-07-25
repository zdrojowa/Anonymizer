<?php


final class EmailProviderTest extends \PHPUnit\Framework\TestCase
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

    public function testAnonymizeArray() {
        $emails = [
            'test@test.pl',
            'test2@test.pl',
            'test3@test.pl',
            'test4@test.pl',
        ];

        $this->assertFalse($emails === $this->provider->anonymize($emails));
    }

    public function testAnonymizeAssocArray() {
        $emails = [
            'test' => 'test@test.pl',
            'test2' => 'test2@test.pl',
            'test3' => 'test3@test.pl',
            'test4' => 'test4@test.pl',
        ];

        $anonymized = $this->provider->anonymize($emails);

        $this->assertFalse($emails === $anonymized);

        foreach ($emails as $key => $email) {
            $this->assertTrue(key_exists($key, $anonymized));
            $this->assertFalse($emails[$key] === $anonymized[$key]);
        }
    }

    public function testDeepAnonymize() {
        $emails = [
            "test" => [
                "test" => [
                    "test" => [
                        "test" => [
                            "test" => "test@test.pl"
                        ]
                    ]
                ]
            ]
        ];

        $anonymized = $this->provider->anonymize($emails);

        $this->assertFalse($emails["test"]["test"]["test"]["test"]["test"] === $anonymized["test"]["test"]["test"]["test"]["test"]);

    }
}