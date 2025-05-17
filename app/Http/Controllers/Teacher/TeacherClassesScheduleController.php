<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherSaveClassScheduleRequest;
use App\Http\Resources\ClassScheduleResource;
use App\Services\IClassScheduleServices;
use Illuminate\Support\Facades\Log;

class TeacherClassesScheduleController extends Controller
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
        return ClassScheduleResource::collection($this->classScheduleServices->getAll(auth()->id()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherSaveClassScheduleRequest $request)
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
        return ClassScheduleResource::make($this->classScheduleServices->find($id, auth()->id()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherSaveClassScheduleRequest $request, int $id)
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
        $this->classScheduleServices->delete($id, auth()->id());
        return response(null, 204);
    }
}
