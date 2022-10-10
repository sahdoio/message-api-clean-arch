<?php

namespace App\Core\Common;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log as FacadesLog;

class Log
{
    private const DEBUG    = 0;
    private const INFO     = 1;
    private const ERROR    = 2;
    private const ALERT    = 3;
    private const CRITICAL = 4;

    /**
     * Do login
     *
     * @param int    $type
     * @param string $message
     *
     * @return void
     */
    private static function doLog(int $type, string $message): void
    {
        $trace        = debug_backtrace();
        $className    = Arr::get($trace, '2.class', '');
        $functionName = Arr::get($trace, '2.function', '');

        $fullMessage = sprintf('%s::%s - %s', $className, $functionName, $message);

        switch ($type) {
            case self::DEBUG:
                FacadesLog::debug($fullMessage);
                break;
            case self::INFO:
                FacadesLog::info($fullMessage);
                break;
            case self::ERROR:
                FacadesLog::error($fullMessage);
                break;
            case self::ALERT:
                FacadesLog::alert($fullMessage);
                break;
            case self::CRITICAL:
                FacadesLog::critical($fullMessage);
                break;
        }
    }

    /**
     * Debug method
     *
     * @param string $message
     *
     * @return void
     */
    public static function debug(string $message): void
    {
        self::doLog(self::DEBUG, $message);
    }

    /**
     * Info method
     *
     * @param string $message
     *
     * @return void
     */
    public static function info(string $message): void
    {
        self::doLog(self::INFO, $message);
    }

    /**
     * Error method
     *
     * @param string $message
     *
     * @return void
     */
    public static function error(string $message): void
    {
        self::doLog(self::ERROR, $message);
    }

    /**
     * Alert method
     *
     * @param string $message
     *
     * @return void
     */
    public static function alert(string $message): void
    {
        self::doLog(self::ALERT, $message);
    }

    /**
     * Critical method
     *
     * @param string $message
     *
     * @return void
     */
    public static function critical(string $message): void
    {
        self::doLog(self::CRITICAL, $message);
    }
}
