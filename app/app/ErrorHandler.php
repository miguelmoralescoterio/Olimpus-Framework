<?php
declare(strict_types=1);
namespace Olimpuss;
umask(0000);
/**
 * Routes File For "public" Site
 */

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;

class ErrorHandler {
    public function exception(FlattenException $exception) {
        $msg = 'Something went wrong! ('.$exception->getMessage().') <br/>';
        $msg.= gettype($exception).'<br/>';
        $msg.= get_class($exception).'<br/>';
        $msg.= $exception->getStatusCode().'<br/>';
        return new Response($msg, $exception->getStatusCode());
    }
}
