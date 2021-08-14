<?php
/**
 * This file is part of the mimmi20/navigation-helper-findroot package.
 *
 * Copyright (c) 2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20\NavigationHelper\FindRoot;

use Laminas\Navigation\AbstractContainer;
use Laminas\Navigation\Page\AbstractPage;
use Mezzio\Navigation\ContainerInterface;
use Mezzio\Navigation\Page\PageInterface;

interface FindRootInterface
{
    /**
     * @param AbstractContainer|ContainerInterface|null $root
     */
    public function setRoot($root): void;

    /**
     * Returns the root container of the given page
     *
     * When rendering a container, the render method still store the given
     * container as the root container, and unset it when done rendering. This
     * makes sure finder methods will not traverse above the container given
     * to the render method.
     *
     * @param AbstractPage|PageInterface $page
     *
     * @return AbstractContainer|ContainerInterface
     */
    public function find($page);
}
