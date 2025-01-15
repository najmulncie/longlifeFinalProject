<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Purchase;


class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'operator' => 'required|string|in:Robi,Airtel,Banglalink,Grameenphone,Teletalk',
            'category' => 'required|string|in:Bundle,Internet,Minute',
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'cashback' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        try {
            // Get the image URL using the model's method
            $imageUrl = Package::getImageUrl($request);
    
            // Save the package
            $package = new Package();
            $package->operator = $request->operator;
            $package->category = $request->category;
            $package->title = $request->title;
            $package->price = $request->price;
            $package->cashback = $request->cashback;
            $package->description = $request->description;
            $package->image = $imageUrl; // Save the image URL
            $package->save();
    
            return redirect()->back()->with('success', 'Package created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'operator' => 'required',
            'category' => 'required',
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'cashback' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $package->update($request->all());
        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }



    public function viewRequests()
    {
        $requests = Purchase::with('user', 'package')->where('status', 'pending')->get();

        return view('admin.packages.purchase_requests', compact('requests'));
    }
    // public function approveRequest($id)
    // {
    //     $purchase = Purchase::findOrFail($id);

    //     // Approve the request
    //     $purchase->status = 'completed';
    //     $purchase->save();

    //     return redirect()->back()->with('success', 'Request approved successfully.');
    // }

    public function approveRequest($purchaseId)
    {
        // Fetch the purchase record
        $purchase = Purchase::findOrFail($purchaseId);

        // Ensure the purchase is still pending
        if ($purchase->status !== 'pending') {
            return redirect()->back()->with('error', 'This purchase is already processed.');
        }

        // Fetch the cashback value from the associated package
        $cashback = $purchase->package->cashback;

        // Update the user's total wallet balance
        $user = $purchase->user;
        $user->total_wallet_amount += $cashback;
        $user->save();

        // Update the purchase status to completed
        $purchase->status = 'completed';
        $purchase->save();

        return redirect()->back()->with('success', 'Purchase approved, and cashback added to the user\'s wallet!');
    }






public function rejectRequest($id)
{
    $purchase = Purchase::findOrFail($id);

    // Refund the amount to the user's wallet
    $user = $purchase->user;
    $user->wallet_balance += $purchase->price;
    $user->save();

    // Mark the purchase as rejected
    $purchase->status = 'rejected';
    $purchase->save();

    return redirect()->back()->with('success', 'Request rejected, and amount refunded successfully.');
}



}
