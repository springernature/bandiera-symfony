<?php

namespace SpringerNature\Symfony\Bandiera\Test\DependencyInjection;

use PHPUnit\Framework\TestCase;
use SpringerNature\Symfony\Bandiera\DependencyInjection\BandieraExtension;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class BandieraBundleTest extends TestCase
{
    /**
     * @test
     */
    public function container_can_be_built(): void
    {
        $container = $this->getContainer(
            [
                'url' => 'http://foo.com',
                'group' => 'foo',
            ]
        );

        $this->assertInstanceOf(Container::class, $container);
    }

    private function getContainer(array $configuration = []): Container
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->setParameter('kernel.cache_dir', 'var/cache');
        $containerBuilder->setParameter('kernel.root_dir', 'kernel/root');
        if (method_exists(Kernel::class, 'getProjectDir')) {
            $containerBuilder->setParameter('kernel.project_dir', '/dir/project/root');
        }
        $containerBuilder->setParameter('kernel.environment', 'test');

        $extension = new BandieraExtension();
        $extension->load(['bandiera' => $configuration], $containerBuilder);

        $containerBuilder->compile();

        return $containerBuilder;
    }
}
