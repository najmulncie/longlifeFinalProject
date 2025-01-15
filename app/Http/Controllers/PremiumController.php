<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Premium;
use App\Models\PremiumOrder;

class PremiumController extends Controller
{
    public function index(){
        return view('admin.premium.index');
    }
    public function store(Request $request)
    {


        // Validation
        $request->validate([
            'title' => 'required|string|unique:premiums',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'initial_cost' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path'); 
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'backend/premium-images/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
        }
    
        // Save the Premium product to the database
        $premium = new Premium();
        $premium->title = $request->title;
        $premium->description = $request->description;
        $premium->image_path = $imageUrl; // Store the path that is saved in the 'public' directory
        $premium->initial_cost = $request->initial_cost;
        $premium->selling_price = $request->selling_price;
        $premium->save();
    
        $notification = array([
            'message'=> 'Premium created successfully!',
            'alert-type'=> 'success'
        ]);
        return redirect()->route('admin.premium.all')->with($notification);
    }

    public function all(){
        $premiums = Premium::latest()->get();
        return view('admin.premium.all', compact('premiums'));
    }

    public function delete($id)
    {
        // Find the premium by ID
        $premium = Premium::findOrFail($id);

        // Perform the delete action
        $premium->delete();

        // Redirect back with a success message
        return redirect()->route('admin.premium.all')->with([
            'message' => 'Premium deleted successfully!',
            'alert-type' => 'success',
        ]);
    }


    public function premiumOrders()
    {
        $premiumOrders = PremiumOrder::all();
        return view('admin.premium.premium_orders', compact('premiumOrders'));

    }



    public function approvePremiumOrder($requestId)
    {
        $premiumRequest = PremiumOrder::findOrFail($requestId);
        $premiumRequest->is_approved = true;
        $premiumRequest->save();

        $this->distributePremiumIncome($premiumRequest);

        return back()->with('success', 'Premium request approved successfully.');
    }

    protected function distributePremiumIncome(PremiumOrder $premiumRequest)
    {
        $levels = [
            1 => 6, 2 => 3, 3 => 2, 4 => 1,
            5 => 1, 6 => 1, 7 => 1, 8 => 0.5,
            9 => 0.5, 10 => 0.5,
        ];
    
        $referrer = User::find($premiumRequest->referred_by);
        $currentLevel = 1;
    
        while ($referrer && $currentLevel <= 10) {
            // Add income to referrer's balance
            $referrer->main_balance += $levels[$currentLevel];
            $referrer->save();
    
            // Move to the next referrer
            $referrer = $referrer->referred_by ? User::find($referrer->referred_by) : null;
            $currentLevel++;
        }
    }
    
    public function rejectOrder($requestId)
    {
        $premiumRequest = PremiumOrder::findOrFail($requestId);

        $user = User::find($premiumRequest->user_id);
        $user->total_wallet_amount += $premiumRequest->selling_price;
        $user->save();

        // Mark the order as rejected
        $premiumRequest->is_approved = null; // Or you can use false if you prefer
        $premiumRequest->save();

        return back()->with('error', 'Premium request rejected and amount refunded.');
    }


    //end method for admin;




    //now start for user 

    public function show()
    {
        $premiums = Premium::latest()->get(); 
        return view('user.premium.show', compact('premiums'));
    }

    public function buyPremium($id){
        $premium = Premium::findOrFail($id); 
        $user = auth()->user();
        return view('user.premium.buy-premium', compact('premium', 'user'));
    }


    public function requestPremium(Request $request)
    {

        $request->validate([
            'gmail' => 'required|email',
            'terms_accepted' => 'accepted',
            'selling_price' => 'required|numeric|min:1',
        ]);
      
        $user = auth()->user();
        $deductionAmount = $request->input('selling_price'); 
        
        if ($user->total_wallet_amount < $deductionAmount) {
             return back()->with('error', 'Not enough wallet balance.');
        }
    
        //Deduct amount and create premium request
        $user->total_wallet_amount -= $deductionAmount;
        $user->save();
    
        PremiumOrder::create([
            'user_id' => $request->user_id, // Authenticated user ID
            'referred_by' => $request->referred_by, // Referral user ID
            'name' => $request->name,
            'selling_price' => $request->selling_price,
            'gmail' => $request->gmail,
            'terms_accepted' => true,
        ]);
    
        $notification=array([
            'message'=> 'Premium request submitted successfully.',
            'alert-type'=> 'success'
        ]);
        return redirect()->route('user.history.premium')->with($notification);
    }

    public function historyPurchase()
    {

        $user = auth()->user();
        $premiumOrders = PremiumOrder::where('user_id', $user->id)
                                     ->orderBy('created_at', 'desc')
                                     ->get(); 

        return view('user.premium.history-premium', compact('premiumOrders'));
    }

}
