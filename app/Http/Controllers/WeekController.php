<?php

namespace App\Http\Controllers;


use App\Models\Taken;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class WeekController extends Controller
{
    public function index()
    {
        // alle taken
        $taken = Taken::where('user_id', Auth::id())
            ->where('deadline', '<=', Carbon::now()->startOfDay())
            ->orderByRaw("
                            CASE status
                                WHEN 'niet klaar' THEN 1
                                WHEN 'klaar' THEN 2
                                ELSE 3
                            END
                        ")
            ->orderByRaw("
                            CASE prioriteit
                                WHEN 'hoog' THEN 3
                                WHEN 'medium' THEN 2
                                WHEN 'laag' THEN 1
                                ELSE 0
                            END DESC
                        ")
            ->orderBy('deadline', 'asc')
            ->get();

        // Format deadlines for each taak
        foreach ($taken as $taak) {
            if ($taak->deadline) {
                $taak->deadline = \Carbon\Carbon::parse($taak->deadline)->format('d-m-Y');
            }
        }

        return view('TakenDatum.week', [
            'taken' => $taken,
        ]);
    }
}

