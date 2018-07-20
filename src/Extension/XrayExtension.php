<?php

namespace TwigXray\Extension;

use TwigXray\NodeVisitor\XrayNodeVisitor;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class XrayExtension extends \Twig_Extension
{
    public function getNodeVisitors()
    {
        return [new XrayNodeVisitor()];
    }
}
