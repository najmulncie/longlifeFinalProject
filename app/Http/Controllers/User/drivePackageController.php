<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use Auth;


class drivePackageController extends Controller
{
    public function index(){
       
        // Fetch the unique operators from the Package model
        $operators = Package::distinct()->pluck('operator'); // Get all unique operators
        
        // Fetch packages for each operator and group them by category
        $packages = [];
        foreach ($operators as $operator) {
            $packages[$operator] = Package::where('operator', $operator)
                                            ->get()
                                            ->groupBy('category'); // Group packages by category
        }

        // Pass the operators and packages to the view
        return view('user.package.index', compact('operators', 'packages'));
    
    }

    public function showPackageForm($id)
    {
        // Fetch package details using the ID
        $package = Package::findOrFail($id);
        $operators = ['Robi', 'Grameenphone', 'Banglalink', 'Teletalk', 'Airtel'];
        $regions = ['Dhaka', 'Chittagong', 'Rajshahi', 'Rangpur', 'Mymensingh', 'Barishal', 'Khulna', 'Sylhet']; // Fetch from DB if needed
    
        return view('user.package.buy', compact('package', 'operators', 'regions'));
    }
    
    public function processPurchase(Request $request)
    {
        // Validate the necessary fields, but not the price
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'mobile' => 'required|regex:/^(\+88)?01[3-9]\d{8}$/',
            'operator' => 'required',
            'region' => 'required',
            'terms' => 'accepted',
            'connection_type' => 'required|in:prepaid,postpaid',
        ]);
        
        // // Fetch the package and user
        $package = Package::findOrFail($request->package_id);
        $user = auth()->user();
    
        // // Use the price from the package model
        $price = $package->price;
    
        // // Check wallet balance
        if ($user->total_wallet_amount < $price) {
            return redirect()->back()->withErrors(['error' => 'Insufficient total wallet balance to purchase this package.']);
        }
        
        // // Deduct the package price from wallet balance
        $user->total_wallet_amount -= $price;
        $user->save();
        
        // Create the purchase record
        Purchase::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'mobile' => $validated['mobile'],
            'operator' => $validated['operator'],
            'region' => $validated['region'],
            'price' => $price,  // Use the price from the package model
            'status' => 'pending', // Set initial status to pending
            'connection_type' => $validated['connection_type'], // Capture the connection type
        ]);    
        
        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Your request has been submitted and is pending admin approval.');
    }
    
 
    public function purchaseHistory()
    {
        $all_purchases = Purchase::latest()->get();
        return view('user.package.purchases-history', compact('all_purchases'));
    }
    
    

}
