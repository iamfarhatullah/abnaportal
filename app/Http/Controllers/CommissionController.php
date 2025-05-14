<?php
namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\University;
use App\Models\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommissionController extends Controller{
    public function index(){
        $universities = University::with('commissions', 'country')->where('country_id', '!=', 166)->orderBy('name', 'asc')->get();
        $portals = Portal::all();
        return view('commissions.index', compact('universities', 'portals'));
    }

    public function edit(){
        $commissions = Commission::with('university', 'portal')->get();
        $universities = University::orderBy('name', 'asc')->where('country_id', '!=', 166)->get();
        $portals = Portal::all();
        return view('commissions.edit', compact('commissions', 'universities', 'portals'));
    }

    public function updateAll(Request $request){
        $request->validate([
            'commissions' => 'required|array',
            'commissions.*.*' => 'required|numeric|min:0|max:100',
        ]);
        DB::beginTransaction();
        try {
            foreach ($request->commissions as $universityId => $portalCommissions) {
                foreach ($portalCommissions as $portalId => $commissionPercentage) {
                    Commission::updateOrCreate(
                        [
                            'university_id' => $universityId,
                            'portal_id' => $portalId,
                        ],
                        [
                            'commission_percentage' => $commissionPercentage,
                            'updated_at' => now(),
                        ]
                    );
                }
            }
            DB::commit();
            return redirect()->route('commissions.index')->with('success', 'All commissions updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating commissions: ' . $e->getMessage());
            return redirect()->route('commissions.index')->with('error', 'Failed to update commissions.');
        }
    }
}
