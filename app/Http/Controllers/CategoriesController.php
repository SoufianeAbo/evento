<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(): View
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function create(Request $request): RedirectResponse
    {   
        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect('/categories');
    }

    public function edit(Request $request): RedirectResponse
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();

        return redirect('/categories');
    }

    public function delete(Request $request): RedirectResponse
    {
        $category = Category::find($request->id);
        $category->delete();

        return redirect('/categories');
    }
}
