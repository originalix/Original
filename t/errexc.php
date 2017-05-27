<?php

ErrorException extends Exception {
/* 属性 */
protected int $severity ;
/* 方法 */
public __construct ([ string $message = "" [, int $code = 0 [, int $severity = E_ERROR [, string $filename = __FILE__ [, int $lineno = __LINE__ [, Exception $previous = NULL ]]]]]] )
final public int getSeverity ( void )

/* 继承的方法 */
final public string Exception::getMessage ( void )
final public Throwable Exception::getPrevious ( void )
final public int Exception::getCode ( void )
final public string Exception::getFile ( void )
final public int Exception::getLine ( void )
final public array Exception::getTrace ( void )
final public string Exception::getTraceAsString ( void )
public string Exception::__toString ( void )
final private void Exception::__clone ( void )
}
>

<?php
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

/* Trigger exception */
strpos();
?>

<?php

function custom_error_handler($number, $string, $file, $line, $context)
{
    // Determine if this error is one of the enabled ones in php config (php.ini, .htaccess, etc)
    $error_is_enabled = (bool)($number & ini_get('error_reporting') );

    // -- FATAL ERROR
    // throw an Error Exception, to be handled by whatever Exception handling logic is available in this context
    if( in_array($number, array(E_USER_ERROR, E_RECOVERABLE_ERROR)) && $error_is_enabled ) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

  // -- NON-FATAL ERROR/WARNING/NOTICE
    // Log the error if it's enabled, otherwise just ignore it
    else if( $error_is_enabled ) {
        error_log( $string, 0 );
        return false; // Make sure this ends up in $php_errormsg, if appropriate
    }
}

/*E_USER_WARNING, E_USER_NOTICE, and any other non-terminating error codes, are useless and act like E_USER_ERROR (which terminate) when you combine a custom ERROR_HANDLER with ErrorException and do not CATCH the error. There is NO way to return execution to the parent scope in the EXCEPTION_HANDLER.*/
error_reporting(E_ALL);
    define('DEBUG', true);
    define('LINEBREAK', "\r\n");

    error::initiate('./error_backtrace.log');

    try
        trigger_error("First error", E_USER_NOTICE);
    catch ( ErrorException $e )
        print("Caught the error: ".$e->getMessage."<br />\r\n" );

    trigger_error("This event WILL fire", E_USER_NOTICE);

    trigger_error("This event will NOT fire", E_USER_NOTICE);


 abstract class error {

        public static $LIST = array();

        private function __construct() {}

        public static function initiate( $log = false ) {
            set_error_handler( 'error::err_handler' );
            set_exception_handler( 'error::exc_handler' );
            if ( $log !== false ) {
                if ( ! ini_get('log_errors') )
                    ini_set('log_errors', true);
                if ( ! ini_get('error_log') )
                    ini_set('error_log', $log);
            }
        }

        public static function err_handler($errno, $errstr, $errfile, $errline, $errcontext) {
            $l = error_reporting();
            if ( $l & $errno ) {

                $exit = false;
                switch ( $errno ) {
                    case E_USER_ERROR:
                        $type = 'Fatal Error';
                        $exit = true;
                    break;
                    case E_USER_WARNING:
                    case E_WARNING:
                        $type = 'Warning';
                    break;
                    case E_USER_NOTICE:
                    case E_NOTICE:
                    case @E_STRICT:
                        $type = 'Notice';
                    break;
                    case @E_RECOVERABLE_ERROR:
                        $type = 'Catchable';
                    break;
                    default:
                        $type = 'Unknown Error';
                        $exit = true;
                    break;
                }

                 $exception = new \ErrorException($type.': '.$errstr, 0, $errno, $errfile, $errline);

                if ( $exit ) {
                    exc_handler($exception);
                    exit();
                }
                else
                    throw $exception;
            }
            return false;
        }

        function exc_handler($exception) {
            $log = $exception->getMessage() . "\n" . $exception->getTraceAsString() . LINEBREAK;
            if ( ini_get('log_errors') )
                error_log($log, 0);
            print("Unhandled Exception" . (DEBUG ? " - $log" : ''));
        }

    }
 ?>

 <?php

header('Content-Type: text/plain');

class ErrorHandler extends Exception {
    protected $severity;

    public function __construct($message, $code, $severity, $filename, $lineno) {
        $this->message = $message;
        $this->code = $code;
        $this->severity = $severity;
        $this->file = $filename;
        $this->line = $lineno;
    }

    public function getSeverity() {
        return $this->severity;
    }
}

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorHandler($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler", E_ALL);

function A() {
    $foo->bar; // Purposely cause error
}

function B($c) {
    A();
}

try {
    B('foobar');
} catch (Exception $e) {
    var_dump($e->getTrace());
}

 ?>

 <?php
  set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
  });

  class MyClass {
    public function methodA() {
      echo("methodA:\n");
      strpos();
    }

    public function methodB() {
      echo("methodB:\n");
      trigger_error("warning message form methodB", E_WARNING);
    }

    public function methodC() {
      echo("methodC:\n");
      throw new ErrorException();
    }

      public function methodD() {
      echo("methodD:\n");
      throw new ErrorException('warning message from methodD', 0,
E_WARNING);
    }

    public function run($i) {
        if ($i === 0) {
          $this->methodA();
        } else if ($i === 1) {
          $this->methodB();
        } else if ($i === 2) {
          $this->methodC();
        } else {
          $this->methodD();
        }
    }

    public function test() {
      for ($i = 0; $i < 4; ++$i) {
        try {
            $this->run($i);
        } catch (ErrorException $e) {
          if ($e->getSeverity() === E_ERROR) {
            echo("E_ERROR triggered.\n");
          } else if ($e->getSeverity() === E_WARNING) {
            echo("E_WARNING triggered.\n");
          }
        }
      }
    }
  }

  $myClass = new MyClass();
  $myClass->test();