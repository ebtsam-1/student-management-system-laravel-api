<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private StudentRepository $studentRepository)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search', false);
        $resocrds = ExampleResource::collection($this->studentRepository->get($search));

        return response()->json(['records' => $records]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $record = $this->studentRepository->show($exam->slug);
        return response()->json(['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $this->studentRepository->store($data);

        return response()->json(['message' => 'creating process in progress']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $data = $request->validated();
        $this->studentRepository->update($exam->slug, $data);
        return response()->json(['message' => 'updating process in progress']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $this->studentRepository->destroy($exam->slug);
        return response()->json(['message' => 'deleting process in progress']);
    }
}
