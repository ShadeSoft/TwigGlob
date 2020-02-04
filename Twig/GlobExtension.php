<?php

namespace ShadeSoft\Twig;

class GlobExtension extends \Twig\Extension\AbstractExtension {

    /**
     * @return array
     */
    public function getFilters() {
        return array(
            new \Twig\TwigFilter('glob', function($pattern, $returnMatch = true) {
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
            })
        );
    }

    public function getName() {
        return 'shadesoft_twig_glob';
    }
}
