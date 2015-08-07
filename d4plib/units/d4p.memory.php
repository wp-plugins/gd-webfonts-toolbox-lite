<?php

/*
Name:    d4pLib_Units: Memory
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Memory')) {
    class d4pLib_Unit_Memory extends d4pLib_UnitType {
        public $base = 'B';

        public function init() {
            $this->name = __("Memory", "d4plib");

            $this->list = array(
                'bit' => __("Bit", "d4plib"),
                'B' => __("Byte", "d4plib"),
                'KB' => __("Kilobyte", "d4plib"),
                'MB' => __("Megabyte", "d4plib"),
                'GB' => __("Gigabyte", "d4plib"),
                'TB' => __("Terabyte", "d4plib"),
                'PB' => __("Petabyte", "d4plib"),
                'CD74' => __("1 CD 74min", "d4plib"),
                'CD80' => __("1 CD 80min", "d4plib"),
                'DVD' => __("1 DVD", "d4plib"),
                'DVDDL' => __("1 DVD Dual Layer", "d4plib"),
                'BD' => __("1 BD", "d4plib"),
                'BDDL' => __("1 BD Dual Layer", "d4plib")
            );

            $this->convert = array(
                'bit' => 0.125,
                'B' => 1,
                'KB' => 1024,
                'MB' => 1048576,
                'GB' => 1073741824,
                'TB' => 1099511627800,
                'PB' => 1125899906800000,
                'CD74' => 681058304,
                'CD80' => 736279247,
                'DVD' => 5046586572.8,
                'DVDDL' => 9126805504,
                'BD' => 26843545600,
                'BDDL' => 53687091200
            );
        }
    }
}

?>