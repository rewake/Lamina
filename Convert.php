<?php
/**
 * Created by PhpStorm.
 * User: rkomatz
 * Date: 8/5/2015
 * Time: 2:29 PM
 */

namespace Rewake\Lamina;


class Convert
{
    private static $instance = NULL;

    /**
     * Flush output on destruction
     */
    public function __destruct()
    {
        echo self::$instance->flush();
    }

    /**
     * Return instance for chaining
     * @return self
     */
    public function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function from()
    {
        self::getInstance();


    }

    public function to()
    {
        self::getInstance();


    }

}



