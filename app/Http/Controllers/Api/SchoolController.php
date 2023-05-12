<?php

namespace App\Http\Controllers\Api;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Repositories\SchoolRepository;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private SchoolRepository $schoolRepository)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $records = $this->schoolRepository->get([],$search);

        return response()->json(['records' => SchoolResource::collection($records)->resource]);
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        $record = new SchoolResource($school);
        return response()->json(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        $data = $request->validated();
        $this->schoolRepository->store($data);

        return response()->json(['message' => 'creating process in progress']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $data = $request->validated();
        $this->schoolRepository->update($school, $data);

        return response()->json(['message' => 'updating process in progress']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $this->schoolRepository->destroy($school);
        return response()->json(['message' => 'deleting process in progress']);
    }
}
