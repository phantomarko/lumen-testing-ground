<?php

namespace App\Ui\Rest\Core\Service;

use App\Application\Core\Exception\NotFoundException;
use App\Ui\Rest\Core\Response\BaseResponse;
use Illuminate\Contracts\Support\Responsable;
use Laravel\Lumen\Exceptions\Handler as LumenExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ExceptionHandler extends LumenExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     */
    protected $dontReport = [];

    /**
     * Report or log an exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $e): Response
    {
        if (method_exists($e, 'render')) {
            return $e->render($request);
        } elseif ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        switch ($e) {
            case $e instanceof NotFoundException:
                $e = new NotFoundHttpException($e->getMessage(), $e);
                break;
            default:
                break;
        }

        return $this->prepareJsonResponse($request, $e);
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {
        return new BaseResponse(
            null,
            $this->isHttpException($e) ? $e->getStatusCode() : 500,
            $e->getMessage(),
            $this->isHttpException($e) ? $e->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
