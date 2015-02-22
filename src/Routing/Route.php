<?php
/**
 * Representation of a Route
 *
 * @package     \RPGL\Routing
 * @author      Calmacil <thomas.lenoel@gmail.com>
 * @version     0.1
 * @copyright   (C) 2015 Calmacil <thomas.lenoel@gmail.com>
 * @license     GPLv3.0
 */

namespace RPGL\Routing;

class Route
{
    /**
     * Route's unique name.
     *
     * @var string
     */
    private $_name;

    /**
     * Route's POSIX Regex pattern
     *
     * @var string
     */
    private $_pattern;

    /**
     * Route's named parameters, param_name => default_value
     *
     * @var array
     */
    private $_params = array();

    /**
     *
     */
    private $_params_values = array();

    /**
     * Controller's namespace and name
     *
     * @var string
     */
    private $_controller;

    /**
     * Called action's function name
     *
     * @var string
     */
    private $_action;


    /**
     * Fills the Route data
     *
     * @param string $name      The Route's name
     * @param array $data       An array containing data from config/routes.json
     */
    public function __construct($name, $data, $matches=null)
    {
        if (!(array_key_exists("pattern", $data)
        && array_key_exists("controller", $data)
        && array_key_exists("action", $data))) {
            throw new \InvalidArgumentException("This is not a valid route.");
            return false;
        }

        $this->_name = $name;
        $this->_pattern = $data["pattern"];
        $this->_params = $data["params"];
        $this->_controller = $data["controllers"];
        $this->_action = $data["action"];

        // We have values
        if (is_array($matches) && !empty($matches)) {
            $par_names = array_keys($this->_params);
            foreach ($par_names as $index => $par_name) {
                $this->_params_values[$par_name] = $matches[$index+1];
            }
        }
    }

    /**
     * Getter for route's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Returns a param's value, or default if value is not set
     *
     * @return string
     */
    public function getParam($param)
    {
        if (!array_key_exists($param, $this->_params)) {
            throw new \InvalidArgumentException("This parameter does not exists.");
        }

        if (array_key_exists($param, $this->_params_values)) {
            return $this->_params_values[$param];
        }

        return $this->_params[$param];
    }

    /**
     * Returns the route's controller name and namespace
     *
     * @return string
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * Returns the route's invoked action name
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }
}


// vi: ts=4 sts=4 sw=4 et
