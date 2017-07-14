<?php
namespace Facebook\Http\Controllers;
Use Illuminate\Http\Request;
Use Facebook\Models\Category;
Use Auth;
Use Image;

class CategoryController extends Controller
{
    public function index() {
      $categories = Category::where('status','1')->get();
      return view('categories.index')->with('categories', $categories);
    }

    public function getAddNew() {
      return view('categories.add-new');
    }

    public function addNew(Request $request) {
      $this->validate($request, [
        'category_name' => 'required|min:5|max:255|unique:categories',
        'category_details' => 'required|min:20|max:255',
      ]);

      if ($request->hasFile('category_image')) {
         $category_image = $request->file('category_image');
         $filename = time(). '.' . $category_image->getClientOriginalExtension();
         Image::make($category_image)->resize(250, 100)->save( public_path('images/category-images/'.$filename));
      } else {
        $filename = 'default-category.png';
      }

      Category::create([
        'category_name' => $request->category_name,
        'category_details' => $request->category_details,
        'category_image' => $filename,
        'status' => '0',
      ]);

      return redirect()->route('categories.index')->with('info','Your request of adding new category sent successfully, current status of request is Pending.');

    }
}
