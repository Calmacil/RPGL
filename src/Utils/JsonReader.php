<?php
/**
 * This file is a part of the Calmacil/rpgl project
 *
 * Eases and normalises reading and use of JSON config files
 *
 * @package     RPGL\Utils
 * @author      Calmacil <thomas.lenoel@gmail.com>
 * @version     0.1
 * @copyright   (C) 2014 Calmacil <thomas.lenoel@gmail.com>
 * @license     GPL-3.0
 */

namespace \RPGL\Utils;


class JsonReader
{
    /**
     * Path of the JSON file
     *
     * @var string $_path
     */
    private $_path = "";

    /**
     * Data
     *
     * @var array $_data
     */
    private $_data = Array();

    /**
     * Loads the file
     * @return success
     */
    private function load()
    {
        if (!is_file($this->_path))
            throw new RuntimeException("File {$this->_path} does not exist!");

        $string = file_get_contents($this->_path);
        if (($data = json_decode($string)) == false)
            throw new RuntimeException("Can't decode JSON file: "
            . print_r(error_get_last(), true));

        $this->_data = $data;
        return true;
    }

    /**
     * Loads and read a JSON config file
     *
     * @param string $path      The path of the JSON file
     */
    private function __construct($path)
    {
        $this->_path = $path;
        $this->load();
    }
}
