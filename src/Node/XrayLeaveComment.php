<?php

namespace TwigXray\Node;

use Twig\Node\Node;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class XrayLeaveComment extends Node implements \Twig_NodeOutputInterface
{
    public function __construct($type, $hash)
    {
        parent::__construct(array(), array('type' => $type, 'hash' => $hash));
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->write('echo ')
            ->string(sprintf("<!--XRAY END %s %s-->\n", $this->getAttribute('type'), $this->getAttribute('hash')))
            ->raw(";\n")
        ;
    }
}
