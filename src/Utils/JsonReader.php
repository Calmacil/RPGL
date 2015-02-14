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

namespace RPGL\Utils;

use InvalidArgumentException;

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
        if (($data = json_decode($string, true)) == false)
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
    public function __construct($path)
    {
        $this->_path = $path;
        $this->load();
    }


    /**
     * Returns the value corresponding to the given key
     * Format: some.key.to.get.value.of
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if (!is_string($key)) {
            throw new \InvalidArgumentException("variable \$key must be a string.");
        }

        $keys = explode(".", $key);
        if ($value=self::array_get_recursive($this->_data, $keys)) {
            return $value;
        }
        throw new \InvalidArgumentException("Unable to find key ".$key." in "
            . $this->_path . ".");
        return false;
    }


    private static function array_get_recursive($data, $keys)
    {
        if (empty($keys) || !is_array($data) || !is_array($keys)) {
            throw new \InvalidArgumentException("Cannot return value of an emtpy key");
            return false;
        }

        $key = array_shift($keys);
        echo $key."\n";
        echo print_r($keys, true)."\n";
        if (!array_key_exists($key, $data)) {
            throw new \InvalidArgumentException("Unable to find this key");
            return false;
        }

        if (empty($keys))
            return $data[$key];
        return self::array_get_recursive($data[$key], $keys);
    }
}
