<?php

/*
Name:    d4pLib_Units: Sound
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Sound')) {
    class d4pLib_Unit_Sound extends d4pLib_UnitType {
        public $base = 'B';

        public function init() {
            $this->name = __("Sound", "d4plib");

            $this->list = array(
                'B' => __("Bel", "d4plib"),
                'dB' => __("Decibel", "d4plib"),
                'neper' => __("Neper", "d4plib")
            );

            $this->convert = array(
                'B' => 1,
                'dB' => 10,
                'neper' => 1.1512779
            );
        }
    }
}

?>