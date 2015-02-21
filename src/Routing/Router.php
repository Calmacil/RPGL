<?php
/**
 * Short description for Router.php
 *
 * @package     Router
 * @author      Calmacil <thomas.lenoel@gmail.com>
 * @version     0.1
 * @copyright   (C) 2015 Calmacil <thomas.lenoel@gmail.com>
 * @license     all rights reserved
 */

namespace RPGL\Routing;

use \RPGL\Utils\JsonReader;

class Router extends JsonReader
{
    public function __construct($path)
    {
        parent::__construct($path);
    }
}

// vi: ts=4 sts=4 sw=4 et encoding=utf8
