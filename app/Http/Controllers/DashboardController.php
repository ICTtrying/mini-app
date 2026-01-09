<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //kleuren en berichten --------------------------------------------------------
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
        //einde kleuren en berichten --------------------------------------------------


        //alle taken
        $taken = Taken::where('user_id', Auth::id())->get();

        //alle taken die in de laatste week op klaar staan
        $klaarWeekCount = Taken::where('user_id', Auth::id())
            ->where('status', 'klaar')
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        //taken die niet af zijn
        $nietKlaarCount = Taken::where('user_id', Auth::id())
            ->where('status', 'niet klaar')
            ->count()-1;

        
        return view('dashboard', compact('taken', 'klaarWeekCount', 'gekozenBericht', 'gekozenKleur', 'nietKlaarCount'));

    }
}
