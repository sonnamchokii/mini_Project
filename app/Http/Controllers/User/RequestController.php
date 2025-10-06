<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use App\Models\Request as UserRequest; // Alias to avoid conflict with Illuminate\Http\Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display the catalog of available, requestable Asset Models.
     */
    public function index()
    {
        $requestableModels = AssetModel::where('is_requestable', true)
            ->withCount(['assets as available_count' => function ($query) {
                $query->where('status', 'Available');
            }])
            ->withCount('assets as total_assets') // Get total count for display
            ->get();
        
        return view('user.requests.index', [
            'models' => $requestableModels,
        ]);
    }

    /**
     * Display the form to submit a request for a specific Asset Model.
     * @param int $modelId The ID of the AssetModel the user wants to request.
     */
    public function create(AssetModel $model) // Use route model binding
    {
        // Check if the model is actually requestable before showing the form
        if (!$model->is_requestable) {
            return redirect()->route('user.requests.index')->with('error', 'This item is not currently requestable.');
        }

        // Get available count to display on the form
        $model->available_count = $model->getAvailableCountAttribute(); 

        return view('user.requests.create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Handle the submission of a new asset request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_model_id' => ['required', 'exists:asset_models,id'],
            'justification' => ['required', 'string', 'max:1000'],
            'needed_by_date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        UserRequest::create([
            'user_id' => Auth::id(),
            'asset_model_id' => $request->asset_model_id,
            'needed_by_date' => $request->needed_by_date,
            'justification' => $request->justification,
            'status' => 'Pending', // Default status for new requests
        ]);
        
        return redirect()->route('user.requests.status')->with('success', 'Your request has been submitted for review!');
    }
    
    /**
     * Display the list of the user's pending and historical requests.
     */
    public function status()
    {
        $userRequests = UserRequest::where('user_id', Auth::id())
            ->with('assetModel') // Eager load the asset model to display its name
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.requests.status', [
            'requests' => $userRequests,
        ]);
    }

    /**
     * Cancel a pending asset request.
     */
    public function cancel(UserRequest $requestToCancel) // Use route model binding
    {
        // Ensure the request belongs to the authenticated user and is pending
        if ($requestToCancel->user_id !== Auth::id() || $requestToCancel->status !== 'Pending') {
            return redirect()->back()->with('error', 'You can only cancel your own pending requests.');
        }

        $requestToCancel->update(['status' => 'Cancelled']);

        return redirect()->back()->with('success', 'Your request has been cancelled.');
    }
}