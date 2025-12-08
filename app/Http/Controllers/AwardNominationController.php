<?php

namespace App\Http\Controllers;

class AwardNominationController extends Controller
{
    public function nominate(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:award_categories,id',
        ]);

        $userId = auth()->id();

        // Check ownership
        $owns = DB::table('user_game_library')
            ->where('user_id', $userId)
            ->where('game_id', $request->game_id)
            ->exists();

        if (! $owns) {
            return response()->json(['message' => 'You can only nominate games you own.'], 400);
        }

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
