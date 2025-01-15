<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessionalService;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;


class ProfessionalServiceController extends Controller
{
    public function index()
    {
        return view('admin.professional.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'react_count' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $professional = new ProfessionalService();
        $professional->title = $request->title;
        $professional->description = $request->description;
        $professional->react_count = $request->react_count;
        $professional->price = $request->price;
        $professional->save();
    
       
        return redirect()->route('admin.professional.all')->with('success','Professional Service created successfully!' );
    }

    public function all(){
        $professionals = ProfessionalService::latest()->get();
        return view('admin.professional.all', compact('professionals'));
    }
    
    public function delete(ProfessionalService $professional_service)
    {
        $professional_service->delete();
        return redirect()->route('admin.professional.all')->with('success', 'Professional deleted successfully.');
    }

    public function viewAll()
    {
        $professionals = ProfessionalService::latest()->get();
        return view('user.professional.viewAll', compact('professionals'));
    }



    public function storeRequest($id)
    {
        $service = ProfessionalService::findOrFail($id);
        $user = Auth::user();

        if($user->total_wallet_amount < $service->price)
        {
            return redirect()->back()->with('error', 'Insufficient Total Wallet Amount.');
        }
        $user->total_wallet_amount -= $service->price;
        $user->save();

        // Store the user's request
        ServiceRequest::create([
            'user_id' => Auth::id(),
            'professional_service_id' => $id,
            'status' => 'pending',
        ]);


        return redirect()->back()->with('success', 'Request submitted successfully!');
    }

    public function adminRequests()
    {
        // View all requests for admin
        $requests = ServiceRequest::with(['user', 'professionalService'])->latest()->get();
        return view('admin.professional.request', compact('requests'));
    }

    public function updateRequestStatus(Request $request, ServiceRequest $serviceRequest)
    {
        // Update the request status
        $request->validate([
            'status' => 'required|string|in:pending,accepted,rejected',
        ]);
        
        if ($request->status === 'rejected' && $serviceRequest->status !== 'rejected') {
            // Fetch the user and the associated professional service
            $user = $serviceRequest->user;
            $service = $serviceRequest->professionalService;
    
            $user->total_wallet_balance += $service->price;
            $user->save();
        }
    

        $serviceRequest->status = $request->status;
        $serviceRequest->save();

        return redirect()->back()->with('success', 'Request status updated successfully!');
    }

    public function userHistory()
    {
        // View the user's request history
        $requests = ServiceRequest::where('user_id', Auth::id())->with('professionalService')->get();
        return view('user.professional.request-history', compact('requests'));
    }
    



}
