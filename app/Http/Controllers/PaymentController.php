<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Pengguna;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use PDF;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        // Ambil semua data payments dengan pagination
        $payments = Payment::latest()->paginate(10);

        // Hitung statistik
        $totalPayments = Payment::count();
        $totalRevenue = Payment::sum('price');
        $totalPackages = Payment::distinct('package')->count();
        $totalMethods = Payment::distinct('payment_method')->count();

        return view('payments.index', compact(
            'payments',
            'totalPayments',
            'totalRevenue',
            'totalPackages',
            'totalMethods'
        ));
    }

    public function create()
    {
        $methods = ['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri', 'Credit Card'];
        return view('payments.create', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', Rule::in(['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri', 'Credit Card'])],
            'package' => ['required', Rule::in(['Genius', 'Professor'])],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        Payment::create([
            'payment_method' => $request->payment_method,
            'package' => $request->package,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment berhasil disimpan.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $methods = ['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri', 'Credit Card'];
        return view('payments.edit', compact('payment', 'methods'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_method' => ['required', Rule::in(['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri', 'Credit Card'])],
            'package' => ['required', Rule::in(['Genius', 'Professor'])],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        $payment->update([
            'payment_method' => $request->payment_method,
            'package' => $request->package,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment berhasil diupdate.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function showPlans()
    {
        // Get all payment plans and group by package
        $payments = Payment::orderBy('price', 'asc')
            ->get()
            ->groupBy('package');

        // Get user data if logged in
        $user = Pengguna::find(session('user_id'));

        return view('payments.upgrade-plans', compact('payments', 'user'));
    }

    public function checkout($plan)
    {
        // Find the payment plan
        $payment = Payment::findOrFail($plan);

        // Get user data
        $user = Pengguna::find(session('user_id'));

        if (!$user) {
            return redirect()->route('auth.login')
                ->with('message', 'Silakan login terlebih dahulu untuk melakukan upgrade.');
        }

        // Calculate totals
        $subtotal = $payment->price;
        $adminFee = 2500;
        $tax = round($subtotal * 0.11); // 11% tax
        $total = $subtotal + $adminFee + $tax;

        return view('payments.checkout', compact('payment', 'user', 'subtotal', 'adminFee', 'tax', 'total'));
    }

    public function processPayment(Request $request, $plan)
    {
        try {
            // Validate request
            $request->validate([
                'payment_method' => ['required', Rule::in(['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri'])],
                'agree_to_terms' => ['required', 'accepted']
            ]);

            $payment = Payment::findOrFail($plan);
            $user = Pengguna::find(session('user_id'));

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan. Silakan login kembali.'
                ], 401);
            }

            // Calculate totals
            $subtotal = $payment->price;
            $adminFee = 2500;
            $tax = round($subtotal * 0.11);
            $total = $subtotal + $adminFee + $tax;

            // Create transaction
            $transaction = Transaction::create([
                'transaction_id' => 'EDU-' . date('Y') . '-' . Str::padLeft(Transaction::count() + 1, 6, '0'),
                'user_id' => $user->id,
                'payment_id' => $payment->id,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'admin_fee' => $adminFee,
                'tax' => $tax,
                'total' => $total
            ]);

            return response()->json([
                'success' => true,
                'redirect_url' => route('payments.success', ['transaction' => $transaction->id])
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment Processing Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran'
            ], 500);
        }
    }

    public function downloadReceipt($transactionId)
    {
        $transaction = Transaction::with(['payment', 'pengguna'])->findOrFail($transactionId);

        $pdf = PDF::loadView('payments.receipt', [
            'transaction' => $transaction,
            'payment' => $transaction->payment,
            'user' => $transaction->pengguna // Changed from user to pengguna
        ]);

        return $pdf->download('EDU-Receipt-' . $transaction->transaction_id . '.pdf');
    }

    public function showSuccess(Transaction $transaction)
    {
        return view('payments.success', [
            'transaction' => $transaction,
            'payment' => $transaction->payment,
            'user' => $transaction->pengguna // Add this line to pass user data
        ]);
    }

    public function cancelSubscription()
    {
        try {
            $user = Pengguna::find(session('user_id'));

            // Get latest transaction
            $transaction = Transaction::where('user_id', $user->id)
                ->latest()
                ->first();

            if ($transaction) {
                // Delete the transaction
                $transaction->delete();

                return redirect()->route('upgrade.plans')
                    ->with('success', 'Langganan berhasil dibatalkan');
            }

            return redirect()->route('upgrade.plans')
                ->with('error', 'Tidak ada langganan aktif yang ditemukan');
        } catch (\Exception $e) {
            \Log::error('Subscription Cancellation Error: ' . $e->getMessage());

            return redirect()->route('upgrade.plans')
                ->with('error', 'Terjadi kesalahan saat membatalkan langganan');
        }
    }
}
