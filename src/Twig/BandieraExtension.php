<?php

namespace SpringerNature\Symfony\Bandiera\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BandieraExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('featureFlags', [FeatureFlags::class, 'featureFlags']),
        ];
    }
}
