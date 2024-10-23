<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('products.buy', compact('product'));
    }

    public function charge(Request $request)
    {
        $request->validate([
            'paymentMethodId' => 'required|string',
        ]);

        $user = Auth::user();

        try {
            if (!$user->stripe_id) {
                $user->createAsStripeCustomer();
            }

            $user->addPaymentMethod($request->paymentMethodId);

            $user->charge(1000, $request->paymentMethodId, [
                'return_url' => 'http://localhost/ecom/'
            ]);

            return redirect()->route('products.index')->with('success', 'Payment successful!');
        } catch (CardException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (IncompletePayment $e) {
            return redirect()->back()->with('error', 'Payment Incomplete');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
