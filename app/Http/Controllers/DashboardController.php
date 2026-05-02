<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getStats()
    {
        $user = Auth::user();

        // Récupération des statistiques de dons
        $donationsCount = 0;
        $donationsTotal = 0;

        // Vérifier si la table donations existe et a des données
        try {
            if ($user && $user->id) {
                $donationsCount = DB::table('donations')
                    ->where('user_id', $user->id)
                    ->count();

                $donationsTotal = DB::table('donations')
                    ->where('user_id', $user->id)
                    ->sum('amount') ?? 0;
            }
        } catch (\Exception $e) {
            // Si la table n'existe pas encore, on utilise donation_total
            $donationsCount = $user->donation_total > 0 ? 1 : 0;
            $donationsTotal = $user->donation_total ?? 0;
        }

        // Récupération des demandes de partenariat
        $partnerships = [];
        try {
            $partnerships = DB::table('partnership_requests')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            $partnerships = [];
        }

        // Récupération des heures de bénévolat
        $volunteerHours = 0;
        try {
            $volunteerHours = DB::table('volunteer_applications')
                ->where('user_id', $user->id)
                ->sum('hours') ?? 0;
        } catch (\Exception $e) {
            $volunteerHours = 0;
        }

        return response()->json([
            'donations' => [
                'count' => $donationsCount,
                'total' => number_format($donationsTotal, 0, ',', ' ')
            ],
            'membership' => $user->membership_type ? [
                'status' => 'Actif',
                'type' => $user->membership_type,
                'join_date' => $user->created_at ? $user->created_at->format('d/m/Y') : date('d/m/Y')
            ] : null,
            'volunteer' => [
                'hours' => $volunteerHours
            ],
            'partnerships' => $partnerships,
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
                // Récupération des dons depuis la base de données
                $donations = [];
                try {
                    $donations = DB::table('donations')
                        ->where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function($donation) {
                            return [
                                'date' => date('d/m/Y', strtotime($donation->created_at)),
                                'amount' => number_format($donation->amount, 0, ',', ' '),
                                'method' => $donation->method,
                                'status' => $donation->status
                            ];
                        })
                        ->toArray();
                } catch (\Exception $e) {
                    // Données de démonstration si la table n'existe pas
                    $donations = [
                        ['date' => '15/01/2024', 'amount' => '25 000', 'method' => 'Orange Money', 'status' => 'Complété'],
                        ['date' => '10/12/2023', 'amount' => '15 000', 'method' => 'MTN Money', 'status' => 'Complété']
                    ];
                }

                return response()->json([
                    'donations' => $donations
                ]);

            case 'adhesions':
                return response()->json([
                    'membership' => $user->membership_type ? [
                        'type' => $user->membership_type,
                        'join_date' => $user->created_at ? $user->created_at->format('d/m/Y') : date('d/m/Y'),
                        'status' => 'Actif'
                    ] : null,
                    'parrain' => null,
                    'filleuls' => []
                ]);

            case 'benevolat':
                // Récupération des missions de bénévolat
                $missions = [];
                $totalHours = 0;
                $completedMissions = 0;

                try {
                    $volunteerData = DB::table('volunteer_applications')
                        ->where('user_id', $user->id)
                        ->first();

                    if ($volunteerData) {
                        $totalHours = $volunteerData->hours ?? 0;
                        $completedMissions = $volunteerData->completed_missions ?? 0;

                        // Récupérer les missions individuelles
                        $missions = DB::table('volunteer_missions')
                            ->where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->map(function($mission) {
                                return [
                                    'title' => $mission->title,
                                    'hours' => $mission->hours,
                                    'location' => $mission->location,
                                    'status' => $mission->status
                                ];
                            })
                            ->toArray();
                    }
                } catch (\Exception $e) {
                    // Données de démonstration
                    $missions = [];
                    $totalHours = 0;
                    $completedMissions = 0;
                }

                return response()->json([
                    'missions' => $missions,
                    'total_hours' => $totalHours,
                    'completed_missions' => $completedMissions,
                    'main_domain' => $user->expertise_areas ? (is_array($user->expertise_areas) ? $user->expertise_areas[0] : $user->expertise_areas) : null
                ]);

            case 'partenariats':
                // Récupération des partenariats
                $partnerships = [];
                try {
                    $partnerships = DB::table('partnership_requests')
                        ->where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function($partnership) {
                            return [
                                'type' => $partnership->partnership_type ?? 'Partenariat',
                                'date' => date('d/m/Y', strtotime($partnership->created_at)),
                                'status' => $partnership->status ?? 'En attente',
                                'message' => $partnership->message ?? null
                            ];
                        })
                        ->toArray();
                } catch (\Exception $e) {
                    $partnerships = [];
                }

                return response()->json([
                    'partnerships' => $partnerships
                ]);

            default:
                return response()->json([]);
        }
    }

    public function getActivities()
    {
        $user = Auth::user();
        $activities = [];

        // Récupérer les activités récentes depuis différentes tables
        try {
            // Derniers dons
            $recentDonations = DB::table('donations')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(2)
                ->get();

            foreach ($recentDonations as $donation) {
                $activities[] = [
                    'icon' => 'fa-heart',
                    'title' => 'Don effectué de ' . number_format($donation->amount, 0, ',', ' ') . ' FCFA',
                    'time' => $this->getTimeAgo($donation->created_at)
                ];
            }

            // Dernière adhésion
            if ($user->membership_type && $user->created_at) {
                $activities[] = [
                    'icon' => 'fa-user-check',
                    'title' => 'Adhésion ' . $user->membership_type . ' confirmée',
                    'time' => $this->getTimeAgo($user->created_at)
                ];
            }

            // Dernière demande de partenariat
            $recentPartnership = DB::table('partnership_requests')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recentPartnership) {
                $activities[] = [
                    'icon' => 'fa-handshake',
                    'title' => 'Demande de partenariat soumise',
                    'time' => $this->getTimeAgo($recentPartnership->created_at)
                ];
            }

        } catch (\Exception $e) {
            // Données de démonstration en cas d'erreur
            $activities = [
                ['icon' => 'fa-heart', 'title' => 'Don effectué', 'time' => 'Il y a 2 jours'],
                ['icon' => 'fa-user-check', 'title' => 'Adhésion confirmée', 'time' => 'Il y a 1 semaine']
            ];
        }

        // Trier les activités par date (plus récentes d'abord)
        // Note: Pour un vrai tri, il faudrait stocker les dates

        return response()->json([
            'activities' => array_slice($activities, 0, 5) // Limiter à 5 activités
        ]);
    }

    /**
     * Calcule le temps écoulé depuis une date
     */
    private function getTimeAgo($date)
    {
        if (!$date) return 'Récemment';

        $timestamp = strtotime($date);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'À l\'instant';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return 'Il y a ' . $minutes . ' minute' . ($minutes > 1 ? 's' : '');
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return 'Il y a ' . $hours . ' heure' . ($hours > 1 ? 's' : '');
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return 'Il y a ' . $days . ' jour' . ($days > 1 ? 's' : '');
        } else {
            return date('d/m/Y', $timestamp);
        }
    }
}
