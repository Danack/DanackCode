<?php


namespace Danack\Code\Generator;


class InterfaceGenerator extends ClassGenerator {

    function generateClassDeclaration() {
        return 'interface ' . $this->getName();
    }

    function generateMethods() {
        $output = '';

        $methods = $this->getMethods();
        if (!empty($methods)) {
            foreach ($methods as $method) {
                $output .= $method->generate(true) . self::LINE_FEED;
            }
        }
        return $output;
    }
}

 