<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\PlurialExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PlurialExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('filter_name', [PlurialExtensionRuntime::class, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('plurial', [PlurialExtensionRuntime::class, 'doPlurial']),
        ];
    }
}
