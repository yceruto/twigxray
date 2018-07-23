<?php

namespace TwigXray\Extension;

use TwigXray\NodeVisitor\HtmlDebugNodeVisitor;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class HtmlDebugExtension extends \Twig_Extension
{
    public function getNodeVisitors(): array
    {
        return [new HtmlDebugNodeVisitor()];
    }
}
