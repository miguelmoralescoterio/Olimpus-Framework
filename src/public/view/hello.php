<?php
use Symfony\Component\HttpFoundation\Request;
echo "hello file is here!<br/>";

echo base_url()."<br/>";

$request = Request::createFromGlobals();
$name = $request->get('name', 'World');

echo sprintf('Hello %s', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));