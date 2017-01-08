<?php

namespace Toro\Bundle\CoreBundle\Security\Guard;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class FormAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    private $entryPoint;

    /**
     * @param AuthenticationEntryPointInterface $entryPoint
     */
    public function __construct(AuthenticationEntryPointInterface $entryPoint)
    {
        $this->entryPoint = $entryPoint;
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(null, 403);
        }

        return $this->entryPoint->start($request, $authException);
    }
}
