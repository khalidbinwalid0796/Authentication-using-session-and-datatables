<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    //Read Data
    public function index()
    {
        $products = Product::with('brand','category')->get();
        return view('product.index',compact('products'));
    }
    public function catgory()
    {
    	$category=Category::all();
    	return view('backend.pages.category.category',compact('category'));
    }

    //Create
    public function create()
    {
        $data = [
            'brands' => Brand::toBase()->get(),
            'categories' => Category::toBase()->get(),
        ];
        return view('product.create',$data);
    }
    public function create(){
		$data['suppliers'] = Supplier::all();
		$data['units'] = Unit::all();
		$data['categories'] = Category::all();
	  return view('backend.pages.products.create',$data);
	}
    public function create()
    {
    	$category=DB::table('categories')->get();
    	$brand=DB::table('brands')->get();
    	return view('backend.pages.product.create',compact('category','brand'));
    }

    //Insert
    public function store(Request $request)
	{
	    $product = new Product();
	    $product->supplier_id = $request->supplier_id;
	    $product->unit_id = $request->unit_id;
	    $product->category_id = $request->category_id;
	    $product->name = $request->name;
	    $product->quantity = '0';
	    $product->created_by = Auth::user()->id;
	    $product->save();
        $notification=array(
            'messege'=>'Category Insert Done',
            'alert-type'=>'success'
                  );
        return Redirect()->back()->with($notification);
	}
    public function store(ProductFormRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        if($product){
            session()->flash('success','Data Stored Successfully');
        }else{
            session()->flash('error','Failed To Store Data!');
        }
        return redirect('product');
    }

    //Read Single Data
    //Using Resource Route
    public function show(Product $product)
    {
        return view('product.view',compact('product'));
    }

    //Edit
    //Using Resource Route
    public function edit(Product $product)
    {
        $data = [
            'brands' => Brand::toBase()->get(),
            'categories' => Category::toBase()->get(),
            'product' => $product
        ];
        return view('product.edit',$data);
    }
    $category = Category::find($id);
    $category = Category::where('id',$id)->first();
    $category = Category::findOrFail($id);
    $category = Category::where('id',$id)->get();

    //Update
    //Using Resource Route
    public function update(ProductFormRequest $request, $id)
    {
        $data = $request->validated();
        $product = Product::find($id)->update($data);
        if($product){
            session()->flash('success','Data Updated Successfully');
        }else{
            session()->flash('error','Failed To Update Data!');
        }
        return redirect('product');
    }
    $category = Category::find($id)->update([
        $category->name = $request->name;
    ]);
    public function UpdateCategory(Request $request,$id)
    {
         $data=array();
         $data['category_name']=$request->category_name;
         $update= DB::table('categories')->where('id',$id)->update($data);
        if ($update) {
        	$notification=array(
                 'messege'=>'Category Successfully Updated',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('categories')->with($notification);
        }else{
        	$notification=array(
                 'messege'=>'Nothing to update',
                 'alert-type'=>'success'
                       );
            return Redirect()->route('categories')->with($notification);
        }
    }
    public function update(Request $request, $id)
	{
		$product = Product::find($id);
	    $product->supplier_id = $request->supplier_id;
	    $product->unit_id = $request->unit_id;
	    $product->category_id = $request->category_id;
	    $product->name = $request->name;
		$product->save();
		return redirect()->route('product.view')->with('success','Data updated successfully');
	}

    //Delete
    public function destroy($id)
    {
        $result = Product::find($id)->delete();
        if($result){
            session()->flash('success','Data Deleted Successfully');
        }else{
            session()->flash('error','Failed To Delete Data!');
        }
        return redirect()->back();
    }
	public function delete($id)
	{
		$product = Product::find($id);
		if (!is_null($product)) {
		  $product->delete();
		}
		return back();
	}
}    