<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Traits\ApiResponseSender;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseSender;

    public function __construct(private readonly OrderService $service)
    {
    }

    public function index()
    {
        return $this->successResponse($this->service->index());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->service->store($request->all()));
    }

    public function show(string $id)
    {
        return $this->successResponse($this->service->show($id));
    }

    public function update(Request $request, string $id)
    {
        return $this->successResponse($this->service->update($id, $request->all()));
    }

    public function destroy(string $id)
    {
        return $this->successResponse($this->service->destroy($id));
    }
}
