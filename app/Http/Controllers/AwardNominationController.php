<?php

namespace App\Http\Controllers;

use App\Models\AwardNomination;
use Illuminate\Http\Request;

class AwardNominationController extends Controller
{
    public function nominate(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games_library,id',
            'category_id' => 'required|exists:award_categories,id',
        ]);

        $userId = auth()->id();

        AwardNomination::updateOrCreate(
            [
                'user_id' => $userId,
                'category_id' => $request->category_id,
            ],
            [
                'game_id' => $request->game_id,
            ]
        );

        return response()->json(['message' => 'Nomination submitted successfully!']);
    }
}
