<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
        $validatedData = $this->validator($request);

        $category = Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
        ]);

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
        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('category.show', compact('category', 'posts', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        Gate::authorize('edit', $category);
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
        Gate::authorize('update', $category);
        if ($request->Input('slug') == $category->slug) {
            $validated = $request->validate([
                'name' => ['required', 'max:255'],
            ]);

            $category->update($validated);
        } else {
            $validatedData = $this->validator($request);

            $category->update([
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
            ]);
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
        $uncategorized = Category::uncategorized()->first();

        $this->ChangeCategoryTo($category, $uncategorized);

        $category->delete();

        session()->flash('message', 'The category has been deleted successfully');
        return response()->redirectTo(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */

    public function destroyed() {
        $destroyedCategories = Category::onlyTrashed()->paginate(5);

        return response()->view('category.destroyed', compact('destroyedCategories'));
    }

    /**
     * Restore the specified resource from the database.
     *
     * @param int $id
     * @return void
     */

    public function restore(int $id) {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        session()->flash('message', 'Category has been restored');
        return response()->redirectTo(route('categories.index'));
    }

    private function validator(Request $request) {
        return $request->validate([
           'name' => ['required', 'max:255'],
           'slug' => ['required', 'max:255', 'min:3', 'unique:categories', new Slug()],
        ]);
    }

    public function ChangeCategoryTo(Category $categoryFrom, Category $categoryTo) {
        foreach($categoryFrom->posts as $post) {
            $post->category_id = $categoryTo->id;
            $post->save();
        }
    }
}
