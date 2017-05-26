<?php

ErrorException extends Exception {
/* 属性 */
protected int $severity ;
/* 方法 */
public __construct ([ string $message = "" [, int $code = 0 [, int $severity = E_ERROR [, string $filename = __FILE__ [, int $lineno = __LINE__ [, Exception $previous = NULL ]]]]]] )
final public int getSeverity ( void )