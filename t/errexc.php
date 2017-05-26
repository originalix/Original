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

 ?>