<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Repositories\SubjectRepository;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private SubjectRepository $subjectRepository)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search', false);
        $records = SubjectResource::collection($this->subjectRepository->get($search));

        return response()->json(['records' => $records]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $record = new SubjectResource($this->subjectRepository->show($subject->slug));
        return response()->json(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $this->subjectRepository->store($data);

        return response()->json(['message' => 'creating process in progress']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validated();
        $this->subjectRepository->update($subject->slug, $data);

        return response()->json(['message' => 'updating process in progress']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->subjectRepository->destroy($subject->slug);
        return response()->json(['message' => 'deleting process in progress']);
    }
}
