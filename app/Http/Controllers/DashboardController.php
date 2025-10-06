<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset; // Import the new Asset Model

/**
 * Handles the main dashboard view logic for standard users.
 */
class DashboardController extends Controller
{
    /**
     * Display the standard user dashboard with their currently assigned assets.
     */
    public function index()
    {
        // 1. Get the currently logged-in user's ID
        $userId = Auth::id();

        // 2. Fetch all assets currently assigned to this user
        // We assume an asset is assigned if its 'user_id' column matches the current user's ID.
        // We also use basic dummy data for 'Model' since we haven't created the Model Model yet.
        $assignedAssets = Asset::where('user_id', $userId)
            // Example: Order by the date they were checked out
            ->orderBy('checked_out_at', 'desc') 
            // Mock data structure to emulate real data until 'Model' is created
            ->get()
            ->map(function ($asset) {
                // Mock the Model/Type for display purposes
                $asset->mock_model_name = "Laptop Model " . $asset->id; 
                return $asset;
            });
            
        // 3. Return the view, passing the fetched data
        return view('dashboard', [
            'assignedAssets' => $assignedAssets,
        ]);
    }
}


