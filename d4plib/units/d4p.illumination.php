<?php

/*
Name:    d4pLib_Units: Torque
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Illumination')) {
    class d4pLib_Unit_Illumination extends d4pLib_UnitType {
        public $base = 'lx';

        public function init() {
            $this->name = __("Illumination", "d4plib");

            $this->display = array(
                'uNm' => '&micro;Nm',
                'lmm2' => 'lm/m&sup2;',
                'lmcm2' => 'lm/cm&sup2;',
                'lmft2' => 'lm/ft&sup2;'
            );

            $this->list = array(
                'lx' => __("Lux", "d4plib"),
                'ph' => __("Phot", "d4plib"),
                'nox' => __("Nox", "d4plib"),
                'flame' => __("Flame", "d4plib"),
                'lmm2' => __("Lumen on Square Meter", "d4plib"),
                'lmcm2' => __("Lumen on Square Centimeter", "d4plib"),
                'lmft2' => __("Lumen on Square Foot", "d4plib")
            );

            $this->convert = array(
                'lx' => 1,
                'ph' => 0.0001,
                'nox' => 1000,
                'flame' => 0.02322576,
                'lmm2' => 1,
                'lmcm2' => 0.0001,
                'lmft2' => 0.09290304
            );

            $this->system = array(
                'metric' => array('lx', 'lmm2', 'lmcm2'),
                'imperial' => array('lmft2'),
                'us' => array('lmft2')
            );
        }
    }
}

?>