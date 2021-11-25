<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Infrastructure\Core\Controller\Http\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetProductController extends BaseController
{
    public function execute(Request $request, $id): Response
    {
        return new Response(
            $request->getMethod() . ' ' . str_replace('{id}', $id, route('GetProduct'))
        );
    }
}
