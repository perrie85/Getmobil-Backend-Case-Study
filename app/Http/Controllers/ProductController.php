<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Traits\ApiResponseSender;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponseSender;

    public function __construct(private readonly ProductService $service)
    {
    }

    public function index()
    {
        return $this->successResponse($this->service->index());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->service->store());
    }

    public function show(string $id)
    {
        return $this->successResponse($this->service->show());
    }

    public function update(Request $request, string $id)
    {
        return $this->successResponse($this->service->update());
    }

    public function destroy(string $id)
    {
        return $this->successResponse($this->service->destroy());
    }
}
