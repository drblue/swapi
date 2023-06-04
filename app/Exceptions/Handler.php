<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Throwable  $e
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Throwable
	 */
	public function render($request, Throwable $e)
	{
		// Respond with json if request is an api request
		if ($request->is('api/*')) {
			// Return the correct status code
			switch ($e) {
				case $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException:
					$e = new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($e->getMessage(), $e);
					break;
				case $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException:
					$e = new \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException([], 'Method Not Allowed');
					break;
				default:
					$e = new \Symfony\Component\HttpKernel\Exception\HttpException(500, $e->getMessage(), $e);
					break;
			}

			// Return json response with error message and status code
			return response()->json([
				'error' => $e->getMessage(),
			], $e->getStatusCode());
		}

		return parent::render($request, $e);
	}
}
