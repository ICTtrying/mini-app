<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken
        $taken = Taken::where('user_id', Auth::id())
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

        -// alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
            if ($taak->deadline) {
                $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
            }
        }

        // Always return the view, and pass $succesBericht if set
        return view('dashboard', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null,
        ]);

    }

    public function vandaag(Request $request)

    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('TakenDatum.vandaag', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);
    }

    public function week(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken

        $taken = Taken::where('user_id', Auth::id())
            ->where('deadline', '<=', Carbon::now()->addWeek()->endOfDay())
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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('TakenDatum.week', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);

    }

    public function school(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken

        $taken = Taken::where('user_id', Auth::id())
            ->where('categorie', 'school')
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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('deadline', '<=', Carbon::now()->addWeek()->endOfDay())
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('Takencategorie.school', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);

    }

    public function werk(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken
        $taken = Taken::where('user_id', Auth::id())
            ->where('categorie', 'werk')
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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('Takencategorie.werk', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);

    }

    public function sideProjecten(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken
        $taken = Taken::where('user_id', Auth::id())
            ->where('categorie', 'side-project')
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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('Takencategorie.side-projecten', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);

    }

    public function prive(Request $request)
    {
        $succesBericht = null;
        if ($request->has('taak_id')) {
            $taak = Taken::where('user_id', Auth::id())->where('id', $request->input('taak_id'))->first();

            if ($taak) {
                if ($taak->status === 'niet klaar') {
                    $taak->status = 'klaar';
                } elseif ($taak->status === 'klaar') {
                    $taak->status = 'niet klaar';
                }
                $taak->save();
                $succesBericht = 'taak succesvol gewijzigd';
            }
        }

        // kleuren en berichten --------------------------------------------------------
        $berichten = ['Nice!', 'Goed gedaan!', 'Lekker bezig!', 'Perfect!', 'Je bent op dreef!', 'Fantastisch!'];
        $kleuren = [
            'rgba(79, 70, 229, 0.5)',      // Indigo
            'rgba(147, 51, 234, 0.5)',     // Paars
            'rgba(52, 195, 52, 0.5)',      // Groen
            'rgba(236, 72, 153, 0.5)',     // Roze
            'rgba(14, 165, 233, 0.5)',     // Blauw
            'rgba(245, 158, 11, 0.5)',     // Oranje
            'rgba(20, 184, 166, 0.5)',     // Teal
            'rgba(239, 68, 68, 0.5)',      // Rood
        ];
        $gekozenKleur = $kleuren[array_rand($kleuren)];
        $gekozenBericht = $berichten[array_rand($berichten)];
        // einde kleuren en berichten --------------------------------------------------

        // alle taken
        $taken = Taken::where('user_id', Auth::id())
            ->where('categorie', 'prive')
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

        //
        // alle taken die in de laatste week op klaar staan
        $klaarWeekCount = ($taken)
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        // alle taken die klaar zijn
        $klaarCount = ($taken)
            ->where('status', 'klaar')
            ->count();

        // taken die niet af zijn
        $nietKlaarCount = ($taken)
            ->where('status', 'niet klaar')
            ->count();

        // % klaar
        if ($taken->count() > 0) {
            $procentKlaar = round($klaarCount / $taken->count() * 100);
        } else {
            $procentKlaar = 0;
        }

        foreach ($taken as $taak) {
        if ($taak->deadline) {
            $taak->deadline = Carbon::parse($taak->deadline)->format('d-m-Y');
        }
    }
        
        // Always return the view, and pass $succesBericht if set
        return view('Takencategorie.prive', [
            'taken' => $taken,
            'klaarWeekCount' => $klaarWeekCount,
            'gekozenBericht' => $gekozenBericht,
            'gekozenKleur' => $gekozenKleur,
            'nietKlaarCount' => $nietKlaarCount,
            'procentKlaar' => $procentKlaar,
            'succesBericht' => $succesBericht ?? null
        ]);

    }

    
}
