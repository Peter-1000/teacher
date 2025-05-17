<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminSaveClassScheduleRequest;
use App\Http\Resources\ClassScheduleResource;
use App\Services\IClassScheduleServices;
use Illuminate\Support\Facades\Log;

class AdminClassesScheduleController extends Controller
{
    private IClassScheduleServices $classScheduleServices;

    public function __construct(IClassScheduleServices $classScheduleServices)
    {
        $this->classScheduleServices = $classScheduleServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ClassScheduleResource::collection($this->classScheduleServices->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSaveClassScheduleRequest $request)
    {
        try {
            $schedule = $this->classScheduleServices->create($request->getDto());
            return ClassScheduleResource::make($schedule);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $code = is_int($exception->getCode()) ? $exception->getCode() : 404;
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'status_code' => $code,
            ])->setStatusCode($code);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return ClassScheduleResource::make($this->classScheduleServices->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSaveClassScheduleRequest $request, int $id)
    {
        try {
            $schedule = $this->classScheduleServices->update($id, $request->getDto());
            return ClassScheduleResource::make($schedule);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $code = is_int($exception->getCode()) && $exception->getCode() > 0 ? $exception->getCode() : 404;
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'status_code' => $code,
            ])->setStatusCode($code);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->classScheduleServices->delete($id);
        return response(null, 204);
    }
}
