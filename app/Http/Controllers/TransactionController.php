<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Service;

class TransactionController extends Controller
{
    // tampilkan halaman kasir
    public function index()
    {
        return Inertia::render('kasir/Index');
    }

    // daftar customer (json)
    public function customers()
    {
        return response()->json(
            Customer::select('id', 'customer_name', 'phone', 'address')->orderBy('customer_name')->get()
        );
    }

    // daftar layanan (json)
    public function services()
    {
        return response()->json(
            Service::select('id', 'service_name', 'price')->orderBy('service_name')->get()
        );
    }

    // simpan order + detail
    public function store(Request $request)
    {
        $data = $request->all();

        $validated = $request->validate([
            'id_customer' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'order_end_date' => ['nullable', 'date'],
            'order_status' => ['nullable', 'integer'],
            'order_pay' => ['required', 'numeric', 'min:0'],
            'order_change' => ['nullable', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.id_service' => ['required', 'exists:services,id'],
            'details.*.qty' => ['required', 'integer', 'min:1'],
            'details.*.subtotal' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'id_customer' => $validated['id_customer'],
                'order_date' => $validated['order_date'],
                'order_end_date' => $validated['order_end_date'] ?? null,
                'order_status' => $validated['order_status'] ?? 0,
                'order_pay' => $validated['order_pay'],
                'order_change' => $validated['order_change'] ?? 0,
                'total' => $validated['total'],
            ]);

            foreach ($validated['details'] as $d) {
                OrderDetails::create([
                    'id_order' => $order->id,
                    'id_service' => $d['id_service'],
                    'qty' => $d['qty'],
                    'subtotal' => $d['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Order created'], 201);
        } catch (ValidationException $ve) {
            DB::rollBack();
            throw $ve;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }
}
