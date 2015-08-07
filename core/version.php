<?php

if (!defined('ABSPATH')) exit;

class gdwft_core_info {
    public $code = 'gd-webfonts-toolbox';

    public $version = '1.0.1';
    public $build = 91;
    public $status = 'stable';
    public $edition = 'lite';
    public $released = '2015.08.06';
    public $updated = '2015.08.04';
    public $url = 'https://webfonts.dev4press.com/';
    public $author_name = 'Milan Petrovic';
    public $author_url = 'http://www.dev4press.com/';

    public $install = false;
    public $update = false;
    public $previous = 0;

    function __construct() { }

    public function to_array() {
        return (array)$this;
    }
}

?>