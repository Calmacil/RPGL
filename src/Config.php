<?php
/**
 * This file is a part of the Calmacil/rpgl project
 *
 * @package     Config
 * @author      Calmacil <thomas.lenoel@gmail.com>
 * @version     0.1
 * @copyright   (C) 2015 Calmacil <thomas.lenoel@gmail.com>
 * @license     GPL-3.0
 */

namespace RPGL;

use \RPGL\Utils\JsonReader;

class Config extends JsonReader
{
    /**
     * Instance holder for singleton
     *
     * @var Config $_instance
     */
    private $_instance = null;

    /**
     * Loads and read given config file
     *
     * @param string $path      The path of the JSON file
     */
    private function __construct($path)
    {
        parent::__construct($path);
    }

    /**
     * Implements the singleton
     *
     * @param string $path      The path of the JSON file
     * @return Config
     */
    public static function getInstance($path)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($path);
        }
        return self::$_instance;
    }
}

// vi: ts=4 sts=4 sw=4 et encoding=utf8
