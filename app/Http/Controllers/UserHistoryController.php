<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use App\Models\VolunteerApplication;
use App\Models\PartnershipRequest;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function index()
    {
        return view('dashboard.historique');
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        $activities = collect();

        // Dons
        $donations = Donation::where('user_id', $user->id)->get()->map(function($d) {
            return [
                'type' => 'donation',
                'amount' => $d->amount,
                'method' => $d->method,
                'status' => $d->status,
                'date' => $d->created_at,
                'description' => "Transaction #{$d->reference}"
            ];
        });

        // Adhésion
        $membership = Membership::where('user_id', $user->id)->first();
        if ($membership) {
            $activities->push([
                'type' => 'membership',
                'type_label' => $membership->type,
                'status' => $membership->status ?? 'active',
                'date' => $membership->created_at,
                'description' => "Adhésion valide jusqu'au " . ($membership->expires_at ? $membership->expires_at->format('d/m/Y') : 'indéfinie')
            ]);
        }

        // Bénévolat
        $volunteerApps = VolunteerApplication::where('user_id', $user->id)->with('mission')->get()->map(function($v) {
            return [
                'type' => 'volunteering',
                'mission_name' => $v->mission->title ?? 'Mission',
                'hours' => $v->hours_validated ?? 0,
                'status' => $v->status,
                'date' => $v->created_at,
                'description' => $v->mission->description ?? ''
            ];
        });

        // Partenariats
        $partnerships = PartnershipRequest::where('user_id', $user->id)->get()->map(function($p) {
            return [
                'type' => 'partnership',
                'title' => $p->organization_name,
                'sector' => $p->sector,
                'status' => $p->status,
                'date' => $p->created_at,
                'description' => $p->message
            ];
        });

        $activities = $activities->concat($donations)->concat($volunteerApps)->concat($partnerships)->sortByDesc('date')->values();

        $perPage = 10;
        $page = $request->get('page', 1);
        $paginated = $activities->slice(($page - 1) * $perPage, $perPage);

        return response()->json([
            'activities' => $paginated->values(),
            'hasMorePages' => $activities->count() > $page * $perPage
        ]);
    }
}
