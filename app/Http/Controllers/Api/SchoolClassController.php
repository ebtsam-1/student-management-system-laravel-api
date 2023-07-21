<?php

namespace App\Http\Controllers\Api;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SchoolClassRepository;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private SchoolClassRepository $schoolClassRepository)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search', false);
        $records = $this->schoolClassRepository->get($search);

        return response()->json(['records' => $records]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $model)
    {
        $record = new ExampleResource($this->schoolClassRepository->show($model->slug));
        return response()->json(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $this->schoolClassRepository->store($data);

        return response()->json(['message' => 'creating process in progress']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mode $model)
    {
        $data = $request->validated();
        $this->schoolClassRepository->update($model->slug, $data);

        return response()->json(['message' => 'updating process in progress']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $model)
    {
        $this->schoolClassRepository->destroy($model->slug);
        return response()->json(['message' => 'deleting process in progress']);
    }
}
