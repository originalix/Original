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
