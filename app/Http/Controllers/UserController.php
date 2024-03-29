<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\ApiResponseSender;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseSender;

    public function __construct(private readonly UserService $service)
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

    public function show(int $id)
    {
        return $this->successResponse($this->service->show($id));
    }

    public function update(Request $request, int $id)
    {
        return $this->successResponse($this->service->update($id, $request->all()));
    }

    public function destroy(int $id)
    {
        return $this->successResponse($this->service->destroy($id));
    }
}
