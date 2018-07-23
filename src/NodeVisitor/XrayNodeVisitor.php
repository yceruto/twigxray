<?php

namespace TwigXray\NodeVisitor;

use TwigXray\Node\XrayEnterComment;
use TwigXray\Node\XrayLeaveComment;

/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class XrayNodeVisitor extends \Twig_BaseNodeVisitor
{
    public const TEMPLATE = 'TEMPLATE';
    public const BLOCK = 'BLOCK';
    public const MACRO = 'MACRO';

    protected function doEnterNode(\Twig_Node $node, \Twig_Environment $env)
    {
        return $node;
    }

    protected function doLeaveNode(\Twig_Node $node, \Twig_Environment $env)
    {
        if ($node instanceof \Twig_Node_Module) {
            $hash = md5($node->getTemplateName());
            $node->setNode('display_start', new \Twig_Node(array(
                new XrayEnterComment(self::TEMPLATE, $hash, null, $node->getTemplateName(), $node->getTemplateLine()),
                $node->getNode('display_start'),
            )));
            $node->setNode('display_end', new \Twig_Node(array(
                new XrayLeaveComment(self::TEMPLATE, $hash),
                $node->getNode('display_end'),
            )));
        } elseif ($node instanceof \Twig_Node_Block) {
            $hash = md5($node->getAttribute('name').$node->getTemplateName());
            $node->setNode('body', new \Twig_Node_Body(array(
                new XrayEnterComment(self::BLOCK, $hash, $node->getAttribute('name'), $node->getTemplateName(), $node->getTemplateLine()),
                $node->getNode('body'),
                new XrayLeaveComment(self::BLOCK, $hash),
            )));
        } elseif ($node instanceof \Twig_Node_Macro) {
            $hash = md5($node->getAttribute('name').$node->getTemplateName());
            $node->setNode('body', new \Twig_Node_Body(array(
                new XrayEnterComment(self::MACRO, $hash, $node->getAttribute('name'), $node->getTemplateName(), $node->getTemplateLine()),
                $node->getNode('body'),
                new XrayLeaveComment(self::MACRO, $hash),
            )));
        }

        return $node;
    }

    public function getPriority(): int
    {
        return 0;
    }
}
