<?php

namespace TwigXray\Node;

use Twig\Node\Node;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class XrayEnterComment extends Node implements \Twig_NodeOutputInterface
{
    public function __construct($type, $hash, $name, $template, $lineno)
    {
        parent::__construct(array(), array('type' => $type, 'hash' => $hash, 'name' => $name, 'template' => $template), $lineno);
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo ')
            ->string(sprintf("<!--XRAY START %s %s %s line:%d-->\n", $this->getAttribute('type'), rtrim($this->getAttribute('hash').' '.$this->getAttribute('name')), $this->getAttribute('template'), $this->lineno))
            ->raw(";\n")
        ;
    }
}
