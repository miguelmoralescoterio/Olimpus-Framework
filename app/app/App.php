<?php
declare(strict_types=1);
namespace Olimpuss;
umask(0000);
/**
 * App Kernel
 */

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\EventListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class App extends HttpKernel {
	protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;
    protected $dispatcher;
    protected $requestStack;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver) {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
        $this->requestStack = new RequestStack();

        $this->dispatcher = new EventDispatcher();
		$this->dispatcher->addSubscriber(new RouterListener($this->matcher, $this->requestStack));

		$listener = new ExceptionListener(
		    'Olimpuss\ErrorHandler::exception'
		);
		$this->dispatcher->addSubscriber($listener);

		$this->dispatcher->addSubscriber(new ResponseListener('UTF-8'));
		$this->dispatcher->addSubscriber(new StreamedResponseListener());
		$this->dispatcher->addSubscriber(new StringResponseListener());
        $this->dispatcher->addListener('response', [new \GoogleListener(), 'onResponse']);
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true) {
        try {
            $this->matcher->getContext()->fromRequest($request);
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
            $controller = $this->controllerResolver->getController($request);
            
            $arguments = $this->argumentResolver->getArguments($request, $controller);
            flog(['$arguments 0' => $arguments]);
            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Not Found', 404);
        } catch (\Exception $exception) {
            echo '<h1> 1.  '.ROOT.'storage/access-olimpuss.log</h1>';
            
            $lstError = [
                '<hr/> <b>ENV</b>' => APP_ENV ?? '',
                '<hr/> <b>code</b>' => $exception->getCode() ?? '',
                '<hr/> <b>message</b>' => $exception->getMessage() ?? '',
                '<hr/> <b>line</b>' => $exception->getLine() ?? '',
                '<hr/> <b>file</b>' => $exception->getFile() ?? '',
                '<hr/> <b>trace</b>' => $exception->getTrace() ?? '',
                //'tracestr' => $exception->getTraceAsString() ?? '',
                '<hr/> <b>previous</b>' => $exception->getPrevious() ?? ''
            ];
            return new Response('An error occurred: '.print_r($lstError, true), 500);
        }
    }
}

