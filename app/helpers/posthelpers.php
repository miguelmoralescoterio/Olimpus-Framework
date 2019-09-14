<?php
declare(strict_types=1);
umask(0000);
/**
 * Post Load Helpers File
 */

if(!function_exists('flog')) {
    if(defined('APP_ENV') && APP_ENV == 'development') {
        /**
         * { function_description }
         *
         * @param      <type>  $value  The value
         * @param      ?int    $t      { parameter_description }
         * @param      string  $n      { parameter_description }
         */
        function flog($value, ?int $t =0, $n = null): void {
            //return;
            $fp = fopen(ROOT.'storage/access-olimpuss.log', ($n ? "w+" :"a+"));
            $bakctrace = debug_backtrace();
            //fwrite($fp, PHP_EOL.'['.date('Y-m-d H:i:s').']: '.str_repeat("\t", $t).' '. var_export($value, true).PHP_EOL);
            fwrite($fp, PHP_EOL.'['.date('Y-m-d H:i:s').']: '.str_repeat("\t", $t).' '. print_r($value, true).PHP_EOL);
            if(isset($bakctrace[0]) && isset($bakctrace[0]['file']) && $bakctrace[0]['line']) {
                $bgck = $bakctrace[0]['file'].':'.$bakctrace[0]['line'].' => '.$bakctrace[0]['function'];
                //fwrite($fp, "\t".'['. var_export($bgck, true).']'.PHP_EOL);
                fwrite($fp, "\t".'['. print_r($bgck, true).']'.PHP_EOL);
            }
            if(isset($bakctrace[1]) && isset($bakctrace[1]['file']) && $bakctrace[1]['line']) {
                $bgck = $bakctrace[1]['file'].':'.$bakctrace[1]['line'].' => '.$bakctrace[1]['function'];
                //fwrite($fp, "\t".'['. var_export($bgck, true).']'.PHP_EOL);
                fwrite($fp, "\t".'['. print_r($bgck, true).']'.PHP_EOL);
            }
            if(isset($bakctrace[2]) && isset($bakctrace[2]['file']) && $bakctrace[2]['line']) {
                $bgck = $bakctrace[2]['file'].':'.$bakctrace[2]['line'].' => '.$bakctrace[2]['function'];
                //fwrite($fp, "\t".'['. var_export($bgck, true).']'.PHP_EOL);
                fwrite($fp, "\t".'['. print_r($bgck, true).']'.PHP_EOL);
            }
            fclose($fp);
        }
    } else {
        /**
         * { function_description }
         *
         * @param      <type>  $value  The value
         * @param      ?int    $t      { parameter_description }
         * @param      string  $n      { parameter_description }
         */
        function flog($value, ?int $t =0, $n = null): void {
            return;
        }
    }
}