<?php
namespace Rewake\Lamina;

class Debug
{
    private static $instance = NULL;

    protected $output;
    protected $queue;

    protected $_defaultDumpTitle = "Data Dump";
    protected $_defaultEmailSubject = "Debug Info";

    //-------------------------------
    // Public Functions
    //-------------------------------

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

    /**
     * @param bool|true $formatted
     * @return self
     */
    // TODO: return unformatted
    public function backtrace($formatted = true)
    {
        self::getInstance();
        $bt = debug_backtrace();
        $returnArray = array();

        foreach ($bt as $k => $v) {
            if (!isset($v['file'])) {
                continue;
            }

            $returnArray[] = "{$v['file']}:{$v['line']}->{$v['function']}";
        }

        $returnString = implode("\n", $returnArray);
        self::queue("Backtrace", $returnString);

        return self::$instance;
    }

    /**
     * Display provided debug info. Input will get formatted based on type.
     * @param $input
     * @param null|string $title
     * @return self
     */
    public function info($input, $title = NULL)
    {
        self::getInstance();
        $title = !is_null($title) && !empty($title) ? $title : self::$instance->_defaultDumpTitle;
        self::queue($title, $input);

        return self::$instance;
    }

    /**
     * Email Debug Queue to Provided Email Address
     * @param $emailAddress
     * @param null $subject
     * @return self
     */
    public function email($emailAddress, $subject = NULL)
    {
        self::getInstance();
        $subject = is_null($subject) ? self::$instance->_defaultEmailSubject : $subject ;

        mail(
            $emailAddress,
            $subject,
            self::$instance->flush(),
            "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1"
        );

        return self::$instance;
    }

    /**
     * Display PHP Version
     * @return self
     */
    public function version()
    {
        self::getInstance();
        self::queue("PHP Version", phpversion());

        return self::$instance;
    }

    /**
     * Display Server Information
     * @return self
     */
    public function server()
    {
        self::getInstance();
        $returnArray = array();

        foreach ($_SERVER as $k => $v) {
            $returnArray[] = "<div class=\"debug_inner\"><div class=\"debug_label\">{$k}:</div> <div class=\"debug_value\">{$v}</div></div>";
        }

        $returnString = implode("\n", $returnArray);
        self::queue("Server Info", $returnString);

        return self::$instance;
    }

    /**
     * Display $_REQUEST Information.
     * @return self
     */
    public function request()
    {
        self::getInstance();
        self::queue("REQUEST Data", $_REQUEST);

        return self::$instance;
    }

    /**
     * Display $_GET Information.
     * @return self
     */
    public function get()
    {
        self::getInstance();
        self::queue("GET Data", $_GET);

        return self::$instance;
    }

    /**
     * Display $_POST Information.
     * @return self
     */
    public function post()
    {
        self::getInstance();
        self::queue("POST Data", $_POST);

        return self::$instance;
    }

    /**
     * Display $_SESSION Information.
     * @return self
     */
    public function session()
    {
        self::getInstance();
        self::queue("Session Data", $_SESSION);

        return self::$instance;
    }

    // TODO: finish cookie display method
    public function cookies()
    {
        self::getInstance();

        return self::$instance;
    }

    /**
     * Determine if PHP Extension is installed.
     * @param string $ext
     * @return self
     */
    public function extension($ext)
    {
        self::getInstance();
        $loaded = extension_loaded($ext) ? "TRUE" : "FALSE";
        self::queue("Extension Loaded", "{$ext}: {$loaded}");

        return self::$instance;
    }

    /**
     *
     * @param $test
     * @param $return
     * @param null|string $message
     * @return self
     */
    public function test($test, &$return, $message = null)
    {
        self::getInstance();
        $message = is_null($message) || empty($message) ? "Test Failure" : $message ;

        if (!$return = $test) {
            self::queue($message);
        }

        return self::$instance;
    }

    /**
     * Throws a fatal error in order to stop execution (or, throw error)
     * @return self
     */
    public function fatal()
    {
        // TODO: should we trigger error/throw exception here?
        // TODO: need to pass in something (or set something) as a flag to exit or not.
        // TODO: think about continue and/or break type situations
        //exit;

        return self::$instance;
    }

    /**
     * Exit shorthand.
     */
    public function x()
    {
        exit;
    }

    /**
     * Flush Debug Queue to return string.
     * @return string
     */
    public function flush()
    {
        $f = "";
        foreach (self::$instance->_queue as $q) {
            $f .= self::$instance->show($q['title'], $q['output']);
        }
        return $f;
    }

    //-------------------------------
    // Protected Functions
    //-------------------------------
    protected function getUserId()
    {
        // TODO: might be good to also limit this to
        // TODO: this should probably be offloaded
        if (isset($_SESSION['user']['userid']))	{
            return $_SESSION['user']['userid'];
        }
    }

    protected function getUserEmail()
    {
        // TODO: might be good to also limit this to
        // TODO: this should probably be offloaded
        if (isset($_SESSION['user']['useremail'])) {
            return $_SESSION['user']['useremail'];
        }
    }

    /**
     * Queues messages for later output
     * @param $title
     * @param $output
     */
    protected function queue($title, $output)
    {
        self::getInstance();
        self::$instance->_queue[] = array('title' => $title, 'output' => $output);
    }

    /**
     * Formats and returns data from queue
     * @param $title
     * @param $output
     * @return string
     */
    protected function show($title, $output)
    {
        self::getInstance();

        // Reformat $output
        if (is_null($output)) {
            $output = "[NULL]";
        }
        else if (empty($output)) {
            $output = "[EMPTY]";
        }
        else {
            $output = print_r($output, true);
        }

        // Format the output string to show
        // TODO: it would be nice if formatting was not in the class itself, but I guess it works for the purpose
        $_outString = "";
        $_outString .= <<<EOL
			<style>
				.debug_container { border:1px solid #000; margin-bottom:7px; width:100%; overflow:auto; font-size:12px; font-family:monospace; }
				.debug_title { font-weight:bold; padding:12px; width:150px; float:left; clear:none; background:#000; color:#fff; font-size:12px; font-family:monospace; }
				.debug_content { padding:0 10px; min-width:350px; margin-left:-1px; float:left; clear:none; border-left:1px solid #000; font-size:12px; font-family:monospace; }
				.debug_inner { width:100%; padding:0; margin:0; height:8px; }
				.debug_label { display:table-cell; float:left; min-width:170px; }
				.debug_value { display:table-cell; float:left; }
			</style>
			<div class="debug_container">
				<div class="debug_title">{$title}</div>
				<div class="debug_content"><pre>{$output}</pre></div>
			</div>
EOL;

        self::$instance->output = $_outString;
        return $_outString;
    }

}






