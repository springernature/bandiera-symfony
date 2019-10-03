<?php

namespace SpringerNature\Symfony\Bandiera\Test\DependencyInjection;

use PHPUnit\Framework\TestCase;
use SpringerNature\Symfony\Bandiera\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    /** @test */
    public function dataProviderIsMappingTheRightNumberOfOptions(): void
    {
        $providerData = $this->optionValuesProvider();
        $supportedOptions = \array_unique(\array_column($providerData, 0));

        $expectedCount = $this->getSupportedOptionsCount();

        $this->assertCount(
            $expectedCount,
            $supportedOptions,
            'Provider for configuration options mismatch: ' . PHP_EOL . print_r($supportedOptions, true)
        );
    }

    public function testInvalidDataProviderIsMappingTheRightNumberOfOptions(): void
    {
        $providerData = $this->invalidValuesProvider();
        $supportedOptions = \array_unique(\array_column($providerData, 0));

        $this->assertCount(
            $this->getSupportedOptionsCount(),
            $supportedOptions,
            'Provider for invalid configuration options mismatch: ' . PHP_EOL . print_r($supportedOptions, true)
        );
    }

    /**
     * @dataProvider optionValuesProvider
     */
    public function testOptionValuesProcessing(string $option, $value): void
    {
        $input = [$option => $value];
        $processed = $this->processConfiguration($input);

        $this->assertArrayHasKey($option, $processed);
        $this->assertSame($value, $processed[$option]);
    }

    public function optionValuesProvider(): array
    {
        return [
            ['url', 'http://bandiera-demo.herokuapp.com'],
            ['group', 'my_app'],
        ];
    }

    private function getSupportedOptionsCount(): int
    {
        return 2;
    }

    private function invalidValuesProvider(): array
    {
        return [
            ['url', 42],
            ['group', 42],
        ];
    }

    private function processConfiguration(array $values): array
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), ['bandiera' => $values]);
    }
}
