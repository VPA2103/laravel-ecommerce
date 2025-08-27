<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItems;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders', compact('orders'));
    }
    public function order_details($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if ($order) {
            $orderItems = OrderItems::where('order_id', $order->id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id', $order->id)->first();
            return view('user.order-details', compact('order', 'orderItems', 'transaction'));
        } else {
            return redirect()->route('login');
        }

    }

    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = "Canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with('status', "Order has been canceled successfully!");
    }

    public function account_details()
    {
        $user = Auth()->user();
        return view('user.account-details', compact('user'));
    }
    public function update_account(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->mobile = $request->mobile;

        // Nếu user muốn đổi password
        if ($request->filled('old_password') || $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng']);
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function account_address(Request $request)
    {
        $user_id = Auth::id();

        $addresses = Address::where('user_id', $user_id)
            ->orderByDesc('isdefault')
            ->get();

        return view('user.account-address', compact('addresses'));
    }

    public function address_add()
    {
        return view('user.account-address-add');
    }

    public function address_store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);


        $address = Address::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'locality' => $request->locality,
            'landmark' => $request->landmark,
            'country' => 'Viet Nam',
            'user_id' => Auth::id(),
            'isdefault' => false,
        ]);

        return redirect()->route('user.account.address')->with('success', 'Thêm địa chỉ thành công!');
    }



    public function address_edit($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('user.account-address-edit', compact('address'));
    }

    public function address_update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);

        $address = Address::findOrFail($id);

        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'locality' => $request->locality,
            'landmark' => $request->landmark,
            'country' => 'Viet Nam',
        ]);

        return redirect()->route('user.account.address')
            ->with('success', 'Cập nhật địa chỉ thành công!');
    }
    public function address_delete($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect()->route('user.account.address')->with('success', 'Address Deleted Successfully');
    }

    public function address_set_default($id)
    {
        $user = Auth::user();

        Address::where('user_id', $user->id)->update(['isdefault' => false]);

        Address::where('user_id', $user->id)
            ->where('id', $id)
            ->update(['isdefault' => true]);

        return back()->with('success', 'Đã đặt địa chỉ mặc định!');
    }


}