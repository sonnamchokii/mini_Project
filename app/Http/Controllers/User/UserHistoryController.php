<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Request as UserRequest; // Alias to avoid conflict with Illuminate\Http\Request
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserHistoryController extends Controller
{
    /**
     * Display the user's complete asset and request history.
     */
    public function index(): View
    {
        $userId = Auth::id();

        // Fetch all asset requests (pending, approved, denied, cancelled, fulfilled)
        $userRequests = UserRequest::where('user_id', $userId)
            ->with('assetModel') // Eager load the asset model for display
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch assets that were once assigned to the user but might have been returned or reassigned.
        // This is a simplified approach. In a more complex system, you'd track asset movements
        // through a separate 'asset_logs' or 'assignment_history' table.
        // For now, we'll fetch assets that *were* assigned and include their current status.
        // If an asset is no longer assigned to them, its 'user_id' might be null or different.
        // We'll consider assets whose `user_id` matches the current user or
        // if they were historically assigned (requires a more complex logging system if tracking past assignments).
        // For simplicity, let's assume 'history' here means 'past requests' and 'currently assigned assets'.
        // If you truly need "past assigned assets" that are *no longer* assigned, you need a dedicated logging table.
        // Let's refine this to be *actual* assigned assets and all requests for clarity in this first pass.
        $assignedAssets = Asset::where('user_id', $userId)
            ->with('assignedTo', 'assetModel') // Eager load relationships
            ->orderBy('checked_out_at', 'desc')
            ->get();


        return view('user.history.index', [
            'userRequests' => $userRequests,
            'assignedAssets' => $assignedAssets, // Current assigned assets will also be part of "history"
        ]);
    }
}