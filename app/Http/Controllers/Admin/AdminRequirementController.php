<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminRequirementController extends Controller
{
    public function index(Request $request)
    {
        $query = Requirement::with(['buyer.user', 'category', 'quotes']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where('title', 'like', "%{$term}%")->orWhere('description', 'like', "%{$term}%");
        }

        $requirements = $query->latest()->paginate(15)->withQueryString();

        return view('admin.requirements.index', compact('requirements'));
    }

    public function close($id)
    {
        $requirement = Requirement::findOrFail($id);
        $requirement->update(['status' => 'closed']);

        return back()->with('success', 'Requirement marked as closed.');
    }

    public function destroy($id)
    {
        $requirement = Requirement::findOrFail($id);
        $requirement->delete();

        return back()->with('success', 'Requirement deleted.');
    }
}
