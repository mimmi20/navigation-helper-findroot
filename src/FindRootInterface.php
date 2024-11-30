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

use Laminas\Navigation\AbstractContainer;
use Laminas\Navigation\Page\AbstractPage;
use Mimmi20\Mezzio\Navigation\ContainerInterface;
use Mimmi20\Mezzio\Navigation\Page\PageInterface;

interface FindRootInterface
{
    /**
     * @param AbstractContainer<AbstractPage>|ContainerInterface<PageInterface>|null $root
     *
     * @throws void
     */
    public function setRoot(AbstractContainer | ContainerInterface | null $root): void;

    /**
     * Returns the root container of the given page
     *
     * When rendering a container, the render method still store the given
     * container as the root container, and unset it when done rendering. This
     * makes sure finder methods will not traverse above the container given
     * to the render method.
     *
     * @return AbstractContainer<AbstractPage>|ContainerInterface<PageInterface>
     *
     * @throws void
     */
    public function find(AbstractPage | PageInterface $page): AbstractContainer | ContainerInterface;
}
