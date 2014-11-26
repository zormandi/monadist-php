<?php
require '../bootstrap.php';

use Monadist\Maybe;

function greatGrandParentName($node)
{
    return $node->getParent()->getParent()->getParent()->getName();
}

function greatGrandParentName_safe($node)
{
    if (!is_null($node)) {
        $parent1 = $node->getParent();
        if (!is_null($parent1)) {
            $parent2 = $parent1->getParent();
            if (!is_null($parent2)) {
                $parent3 = $parent2->getParent();
                if (!is_null($parent3)) {
                    return $parent3->getName();
                }
            }
        }
    }
    return null;
}

function greatGrandParentName_maybeBind($node)
{
    return Maybe::unit($node)->bind(function ($node) {
        return Maybe::unit($node->getParent());
    })->bind(function ($parent1) {
        return Maybe::unit($parent1->getParent());
    })->bind(function ($parent2) {
        return Maybe::unit($parent2->getParent());
    })->bind(function ($parent3) {
        return Maybe::unit($parent3->getName());
    })->value();
}

function greatGrandParentName_maybeFmap($node)
{
    return Maybe::unit($node)->fmap(function ($node) {
        return $node->getParent();
    })->fmap(function ($parent1) {
        return $parent1->getParent();
    })->fmap(function ($parent2) {
        return $parent2->getParent();
    })->fmap(function ($parent3) {
        return $parent3->getName();
    })->value();
}

function greatGrandParentName_maybeSugar($node)
{
    return Maybe::unit($node)->getParent()->getParent()->getParent()->getName()->value();
}

$node =
    new Node('leaf',
        new Node('level 1',
            new Node('level 2',
                new Node('root', null))));

//$node = null;

var_dump(greatGrandParentName($node));
var_dump(greatGrandParentName_safe($node));
var_dump(greatGrandParentName_maybeBind($node));
var_dump(greatGrandParentName_maybeFmap($node));
var_dump(greatGrandParentName_maybeSugar($node));

class Node
{
    private $name;
    private $parent;



    public function __construct($name, $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }



    public function getName()
    {
        return $this->name;
    }



    public function getParent()
    {
        return $this->parent;
    }
}
