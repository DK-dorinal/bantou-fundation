<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getStats()
    {
        $user = Auth::user();

        return response()->json([
            'donations' => [
                'count' => $user->donations()->count() ?? 0,
                'total' => number_format($user->donation_total ?? 0, 0, ',', ' ')
            ],
            'membership' => $user->membership_type ? [
                'status' => 'Actif',
                'type' => $user->membership_type,
                'join_date' => $user->created_at->format('d/m/Y')
            ] : null,
            'volunteer' => [
                'hours' => 0 // À calculer selon votre logique
            ],
            'partnerships' => $user->partnershipRequests ?? [],
            'is_donor' => $user->role === 'donateur',
            'is_member' => $user->role === 'adherent',
            'is_volunteer' => $user->role === 'benevole',
            'is_partner' => $user->role === 'partenaire'
        ]);
    }

    public function getTabData(Request $request)
    {
        $user = Auth::user();
        $tab = $request->get('tab');

        switch($tab) {
            case 'dons':
                return response()->json([
                    'donations' => [
                        ['date' => '15/01/2024', 'amount' => '25 000', 'method' => 'Orange Money', 'status' => 'Complété'],
                        ['date' => '10/12/2023', 'amount' => '15 000', 'method' => 'MTN Money', 'status' => 'Complété']
                    ]
                ]);
            case 'adhesions':
                return response()->json([
                    'membership' => $user->membership_type ? [
                        'type' => $user->membership_type,
                        'join_date' => $user->created_at->format('d/m/Y'),
                        'status' => 'Actif'
                    ] : null,
                    'parrain' => null,
                    'filleuls' => []
                ]);
            default:
                return response()->json([]);
        }
    }

    public function getActivities()
    {
        return response()->json([
            'activities' => [
                ['icon' => 'fa-heart', 'title' => 'Don effectué', 'time' => 'Il y a 2 jours'],
                ['icon' => 'fa-user-check', 'title' => 'Adhésion confirmée', 'time' => 'Il y a 1 semaine']
            ]
        ]);
    }
}
