<?php

namespace CoreBundle\Twig\Extension;

class CoreExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'LimitString';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('count', array($this, 'countFilter')),

        );
    }
    public function getFunctions()
    {
        return array(
            'limitstr' => new \Twig_Function_Method($this, 'limitStringFilter')
        );
    }

    public function countFilter($element)
    {
        return count($element);
    }
    public function limitStringFilter($string, $length)
    {
        if(strlen($string) > $length) {
            return substr($string, 0, $length).'...';
        } else {
            return $string;
        }
    }

}
