<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('staff')->only('index');
        $this->middleware('admin')->except('show', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return response()->view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($this->validator($request));

        session()->flash('message', 'The category has been added!');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('category.show', compact('category', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->Input('slug') == $category->slug) {
            $validated = $request->validate([
                'name' => ['required', 'max:255'],
            ]);

            $category->update($validated);
        } else {
            $category->update($this->validator($request));
        }
        $category->save();

        session()->flash('message', 'The category has been updated!');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Cancel this function.
    }

    private function validator(Request $request) {
        return $request->validate([
           'name' => ['required', 'max:255'],
           'slug' => ['required', 'max:255', 'min:3', 'unique:categories'],
        ]);
    }
}
