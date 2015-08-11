<?php
/**
 * Created by PhpStorm.
 * User: rkomatz
 * Date: 8/5/2015
 * Time: 2:28 PM
 */

namespace Rewake\Lamina\Units;

class Length
{
    private $_unit;
    private $_value;

    public function __construct($value)
    {
        $this->setValue($value);
        $this->setUnit();
    }

    public function value($value = null)
    {
        if (is_null($value)) {
            return $this->_value;
        } else {
            $this->_value = $value;
        }
    }

    public function unit($unit)
    {
        if (is_null($unit)) {
            return $this->_unit;
        } else {
            $this->_unit = $unit;
        }
    }

    public function convert($unit)
    {
        // TODO: convert value to units





        $this->unit($unit);
    }

}