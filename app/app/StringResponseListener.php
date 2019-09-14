<?php
declare(strict_types=1);
namespace Olimpuss;
umask(0000);
/**
 * Routes File For "public" Site
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class StringResponseListener implements EventSubscriberInterface {
    public function onView(ViewEvent $event) {
        $response = $event->getControllerResult();

        if (is_string($response)) {
            $event->setResponse(new Response($response));
        }
    }

    public static function getSubscribedEvents() {
        return ['kernel.view' => 'onView'];
    }
}