<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\University;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUniversities = University::count();
        $totalPortals = Portal::count();
        $totalUsers = User::count();
        $universities = University::with('commissions', 'country')->where('country_id', '!=', 166)->orderBy('name', 'asc')->get();

        return view('dashboard', compact('totalUniversities', 'totalPortals', 'totalUsers', 'universities'));
    }

    public function findBestPortal(Request $request)
    {
        $university = University::where('name', $request->input('university_name'))->first();

        if (!$university) {
            return redirect()->back()->with('uni-error', 'University not found');
        }

        $commissions = Commission::where('university_id', $university->id)->with('portal')->orderBy('commission_percentage', 'desc')->get();

        if ($commissions->isEmpty()) {
            return redirect()->back()->with('search-error', $university->name);
        }

        return view('dashboard', [
            'totalUniversities' => University::count(),
            'totalPortals' => Portal::count(),
            'totalUsers' => User::count(),
            'universities' => University::all(),
            'commissions' => $commissions,
            'university' => $university,
        ]);
    }
}
