<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerFavoriteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $favoriteProducts = Favorite::where('user_id', $userId)
            ->whereNotNull('product_id')
            ->with(['product.supplier', 'product.category'])
            ->get();

        $favoriteSuppliers = Favorite::where('user_id', $userId)
            ->whereNotNull('supplier_id')
            ->with(['supplier.subscriptionPlan'])
            ->get();

        return view('buyer.favorites.index', compact('favoriteProducts', 'favoriteSuppliers'));
    }

    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;
        $supplierId = $request->supplier_id;

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('supplier_id', $supplierId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
            $message = 'Item removed from your favorites.';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'supplier_id' => $supplierId,
            ]);
            $status = 'added';
            $message = 'Item saved to your favorites!';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $status,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
