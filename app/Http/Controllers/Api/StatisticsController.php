<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DateChartRequest;

class StatisticsController extends Controller
{
    public function dateChart(DateChartRequest $request)
    {
        $data = $request->validated();
        $records = DB::table('subjects')->select(
    DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
            DB::raw('COUNT(*) AS count'),
            DB::raw('COUNT(CASE WHEN status = 1 THEN 1 END) AS solved'),
            DB::raw('COUNT(CASE WHEN status = 0 THEN 1 END) AS unsolved'),
            )
        ->whereDate('created_at','>=','2023-07-01')
        ->whereDate('created_at','<=','2024-07-22')
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
        ->get();

        // $records =  Subject::selectRaw('DATE(created_at) as x, COUNT(*) as y')
        // ->groupBy('x')
        // ->where('created_at', '<', Carbon::now())
        // ->get();

       $records = Subject::select([
        // DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
        DB::raw('WEEK(created_at) AS week'),
        DB::raw('COUNT(id) AS count'),
        DB::raw('COUNT(CASE WHEN status = 1 THEN 1 END) AS solved'),
        DB::raw('COUNT(CASE WHEN status = 0 THEN 1 END) AS unsolved'),
        ])
        ->whereBetween('created_at', [$data['date_from'], $data['date_to']])
        ->where('category_id', 2)
        ->groupBy('week',
         DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')")
         )
        ->orderBy('week', 'ASC')
        ->get();

        return response()->json(['records' => $records]);

    }
}
