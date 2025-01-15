<?php

namespace App\Http\Controllers;

use App\Models\bkashTaskModel;
use Illuminate\Http\Request;
use function Symfony\Component\Console\Style\success;
use App\Models\nagodTaskModel;


class AdminPaymentTaskGatewayController extends Controller
{
    public function paymentIndex()
    {
        return view('admin.gateway_task.payment_task');
    }

    public function bkashManage()
    {
        $this->bkash = bkashTaskModel::all();
        return view('admin.gateway_task.manage-bkash-task', ['bkashs' => $this->bkash]);
    }
    public function nagodManage()
    {
        $this->nagod = nagodTaskModel::all();
        return view('admin.gateway_task.manage-nagod-task', ['nagods' => $this->nagod]);
    }
    public function nagodDelete($id)
    {
        $task = nagodTaskModel::findOrFail($id);
        $task->delete();

        $notification = array(
            'message' => 'Nagod Task deleted successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
    public function bkashDelete($id)
    {
        $task = bkashTaskModel::findOrFail($id);
        $task->delete();

        $notification = array(
            'message' => 'bKash Task deleted successfully.',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    public function bkashPaymentTaskStore(Request $request)
    {
        $bkashTaskData = $request->validate([
            'bkash_number' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],
            'description' => 'required|string',
        ]);

        bkashTaskModel::create($bkashTaskData);

        $notification = array(
            'message' => 'Bkash Task added successfully.',
             'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function nagodPaymentTaskStore(Request $request)
    {
        $nagodTaskData = $request->validate([
            'nagod_number' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],
            'nagod_description' => 'required|string',
        ]);

        nagodTaskModel::create($nagodTaskData);

        $notification = array(
            'message' => 'Nagod Task added successfully.',
             'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }
}
