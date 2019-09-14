<?php
declare(strict_types=1);
umask(0000);
/**
 * Controller Class for Home
 */
//use Symfony\Component\HttpKernel\Controller;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;

class GoogleListener {

    public function onResponse(ResponseEvent $event) {
        $response = $event->getResponse();

        if ($response->isRedirection()
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $event->getRequest()->getRequestFormat()
        ) {
            return;
        }

        $response->setContent($response->getContent().'GA CODE');
    }
}