<?php

namespace SpringerNature\Symfony\Bandiera\Twig;

use Nature\Bandiera\Client;
use Twig\Extension\RuntimeExtensionInterface;

class FeatureFlags implements RuntimeExtensionInterface
{
    /**
     * @var Client
     */
    private $bandiera;
    /**
     * @var string
     */
    private $group;

    public function __construct(Client $bandiera, string $group = null)
    {
        $this->bandiera = $bandiera;
        $this->group = $group;
    }

    public function featureFlags(string $feature, array $params = [], string $group = null): bool
    {
        $group = $group ?: $this->group;

        if (empty($group)) {
            throw new \RuntimeException('you have to provide a group name, check your configuration');
        }

        return $this->bandiera->isEnabled($group, $feature, $params);
    }
}
