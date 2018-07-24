<?php

namespace App\Exceptions;

use App\LogAbnormal;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Utilities\Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        if ($exception && $exception->getStatusCode()) {
//            return response()->view('errors.'.$exception->getStatusCode(), [],$exception->getStatusCode());
//        }
        LogAbnormal::addExceptionRecord($request,$exception);
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode()
            ], $exception->getStatusCode());
        }
        return parent::render($request, $exception);
        //return parent::render($request, $exception);
    }
}
