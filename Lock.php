<?php
namespace Rewake\Lamina;

/**
 * Lock class, so you can create, destroy, etc lock files.
 *
 * Things in this class that *really* don't belong:
 * Constants: ROOT
 */

class Lock
{
    private static $instance = NULL;

    private $_id		= NULL;
    private $_path		= "phpLockFiles";
    private $_ext		= ".LOCK";
    private $_lifetime	= 86400; // One Day
    private $_handle	= NULL;


    //-------------------------------
    // Public Functions
    //-------------------------------

    public function create($id = NULL)
    {
        self::getInstance();

        if (!self::$instance->_handle = fopen(self::$instance->filepath($id), "w")) {
            throw new Exception("Could not create lock file");
        }

        /*
        if ($this->checkLock($lockFileName))
        {
            if ($reWriteIfFound)
            {
                unlink($fileName);
            }
            else
            {
                return true; // Don't rewrite, leave as is.
            }
        }

        if (!fopen($fileName, "w"))
        {
            trigger_error("Failed to make $fileName for setting lock files.",E_USER_WARNING);
            return false;
        } */

        return self::$instance;
    }


    public function lifetime($seconds)
    {
        self::getInstance();

        // TODO:
        // Hmmm... how do we handle this since no real refernece is being saved?

        if (!empty($seconds) && is_int($seconds)) {
            self::$instance->_lifetime = $seconds;
        }

        return self::$instance;
    }

    public function status($id = NULL)
    {
        self::getInstance();

        // TODO:
        //	time remaining?
        //	exists?

        return self::$instance;
    }

    public static function exists($id = NULL)
    {
        self::getInstance();

        if (file_exists(self::$instance->filepath($id))) {
            if (time() - filemtime(self::$instance->filepath($id)) < self::$instance->_lifetime) {
                return true; // Found & younger than lifetime
            }
        }

        return false;
    }

    public static function destroy($id = NULL)
    {
        self::getInstance();

        if (!unlink(self::$instance->filepath($id))) {
            if (file_exists(self::$instance->filepath($id))) {
                throw new Exception("Lock file exists but could not be removed. Check permissions.");
            }
            else {
                throw new Exception("Lock file does not exist. Check lock ID or Expiry.");
            }
        }

        return true;
    }

    public static function filepath($id = NULL)
    {
        self::getInstance();

        // TODO: error if id empty?
        // TODO: path security?

        // If $id is empty or null, set the ID to calling file's filename
        if (empty($id) || is_null($id)) {
            self::$instance->_id = self::$instance->caller();
        }
        else {
            self::$instance->_id = $id;
        }

        // Create/check path
        if (substr(self::$instance->_path, -1) !== "/") {
            self::$instance->_path = ROOT . self::$instance->_path . "/";
        }

        // Return full path to file
        return self::$instance->_path . self::$instance->_id . self::$instance->_ext;
    }

    public static function caller()
    {
        $file = end(debug_backtrace());
        $file = pathinfo($file['file']);
        return $file['basename'];
    }

    /**
     * Makes class chainable by instantiating itself
     */
    public function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}