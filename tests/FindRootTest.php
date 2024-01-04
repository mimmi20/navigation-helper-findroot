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

namespace Mimmi20Test\NavigationHelper\FindRoot;

use Laminas\Navigation\AbstractContainer;
use Laminas\Navigation\Page\AbstractPage;
use Mimmi20\Mezzio\Navigation\ContainerInterface;
use Mimmi20\Mezzio\Navigation\Page\PageInterface;
use Mimmi20\NavigationHelper\FindRoot\FindRoot;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

final class FindRootTest extends TestCase
{
    private FindRoot $findRoot;

    /** @throws void */
    protected function setUp(): void
    {
        $this->findRoot = new FindRoot();
    }

    /** @throws Exception */
    public function testSetRoot(): void
    {
        $root = $this->createMock(ContainerInterface::class);

        $page = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::never())
            ->method('getParent');
        $page->expects(self::never())
            ->method('hashCode');
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        $this->findRoot->setRoot($root);

        self::assertSame($root, $this->findRoot->find($page));
    }

    /** @throws Exception */
    public function testSetRoot2(): void
    {
        $root = $this->createMock(AbstractContainer::class);

        $page = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::never())
            ->method('getParent');
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        $this->findRoot->setRoot($root);

        self::assertSame($root, $this->findRoot->find($page));
    }

    /** @throws Exception */
    public function testFindRootRecursive(): void
    {
        $root = $this->createMock(ContainerInterface::class);

        $parentPage = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parentPage->expects(self::once())
            ->method('getParent')
            ->willReturn($root);
        $parentPage->expects(self::never())
            ->method('hashCode');
        $parentPage->expects(self::never())
            ->method('getOrder');
        $parentPage->expects(self::never())
            ->method('setParent');

        $page = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::once())
            ->method('getParent')
            ->willReturn($parentPage);
        $page->expects(self::never())
            ->method('hashCode');
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        self::assertSame($root, $this->findRoot->find($page));
    }

    /** @throws Exception */
    public function testFindRootRecursive2(): void
    {
        $root = $this->createMock(AbstractContainer::class);

        $parentPage = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parentPage->expects(self::once())
            ->method('getParent')
            ->willReturn($root);
        $parentPage->expects(self::never())
            ->method('getOrder');
        $parentPage->expects(self::never())
            ->method('setParent');

        $page = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::once())
            ->method('getParent')
            ->willReturn($parentPage);
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        self::assertSame($root, $this->findRoot->find($page));
    }

    /** @throws Exception */
    public function testFindRootWithoutParent(): void
    {
        $page = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::once())
            ->method('getParent')
            ->willReturn(null);
        $page->expects(self::never())
            ->method('hashCode');
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        self::assertSame($page, $this->findRoot->find($page));
    }

    /** @throws Exception */
    public function testFindRootWithoutParent2(): void
    {
        $page = $this->getMockBuilder(AbstractPage::class)
            ->disableOriginalConstructor()
            ->getMock();
        $page->expects(self::once())
            ->method('getParent')
            ->willReturn(null);
        $page->expects(self::never())
            ->method('getOrder');
        $page->expects(self::never())
            ->method('setParent');

        self::assertSame($page, $this->findRoot->find($page));
    }
}
