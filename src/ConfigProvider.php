<?php

/**
 * This file is part of the mimmi20/navigation-helper-findroot package.
 *
 * Copyright (c) 2021-2024, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20\NavigationHelper\FindRoot;

use Laminas\ServiceManager\Factory\InvokableFactory;

final class ConfigProvider
{
    /**
     * Return general-purpose laminas-navigation configuration.
     *
     * @return array<string, array<string, array<string, string>>>
     * @phpstan-return array{dependencies: array{aliases: array<string, class-string>, factories: array<class-string, class-string>}}
     *
     * @throws void
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    /**
     * Return application-level dependency configuration.
     *
     * @return array<string, array<string, string>>
     * @phpstan-return array{aliases: array<string, class-string>, factories: array<class-string, class-string>}
     *
     * @throws void
     */
    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                FindRoot::class => InvokableFactory::class,
            ],
            'aliases' => [
                FindRootInterface::class => FindRoot::class,
            ],
        ];
    }
}
