<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ExamRespository;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private ExamRespository $examRepository)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search', false);
        $resocrds = ExampleResource::collection($this->examRepository->get($search));

        return response()->json(['records' => $records]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $model)
    {
        $record = new ExampleResource($this->examRepository->show($model->slug));
        return response()->json(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $this->examRepository->store($data);

        return response()->json(['message' => 'creating process in progress']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mode $model)
    {
        $data = $request->validated();
        $this->examRepository->update($model->slug, $data);

        return response()->json(['message' => 'updating process in progress']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $model)
    {
        $this->examRepository->destroy($model->slug);
        return response()->json(['message' => 'deleting process in progress']);
    }
}
