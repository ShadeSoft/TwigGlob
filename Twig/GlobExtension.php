<?php

namespace ShadeSoft\Twig;

class GlobExtension extends \Twig_Extension {

    /**
     * @return array
     */
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('glob', array($this, 'glob'))
        );
    }

    /**
     * @param string $pattern
     * @param bool $returnMatch
     * @return array
     */
    public function glob($pattern, $returnMatch = true) {
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        if($returnMatch) {
            $xPattern = explode('*', $pattern);
        }

        $results = array();
        foreach(glob(str_replace('//', '/', "{$rootPath}/{$pattern}")) as $item) {
            $item = str_replace($rootPath, '', $item);

            if($returnMatch) {
                $match = $item;
                foreach($xPattern as $part) {
                    $match = str_replace($part, '', $match);
                }

                $results[$match] = $item;
            } else {
                $results[] = $item;
            }
        }

        return $results;
    }

    public function getName() {
        return 'shadesoft_twig_glob';
    }
}