<?php

/**
 * This file is part of the mimmi20/navigation-helper-findroot package.
 *
 * Copyright (c) 2021-2025, Thomas Mueller <mimmi20@live.de>
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
use Override;

final class FindRoot implements FindRootInterface
{
    /**
     * Root container
     * Used for preventing methods to traverse above the container given to
     * the {@link render()} method.
     *
     * @see find()
     *
     * @var AbstractContainer<AbstractPage>|ContainerInterface<PageInterface>|null
     */
    private AbstractContainer | ContainerInterface | null $root = null;

    /**
     * @param AbstractContainer<AbstractPage>|ContainerInterface<PageInterface>|null $root
     *
     * @throws void
     */
    #[Override]
    public function setRoot(AbstractContainer | ContainerInterface | null $root): void
    {
        $this->root = $root;
    }

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
    #[Override]
    public function find(AbstractPage | PageInterface $page): AbstractContainer | ContainerInterface
    {
        if ($this->root) {
            return $this->root;
        }

        $root = $page;

        while ($parent = $page->getParent()) {
            $root = $parent;

            if (!($parent instanceof PageInterface) && !($parent instanceof AbstractPage)) {
                break;
            }

            $page = $parent;
        }

        $this->root = $root;

        return $root;
    }
}
