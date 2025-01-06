<?php

namespace App\Http\Controllers;
use App\Models\product_category;
use Illuminate\Http\Request;

class productcategoryController extends Controller
{
    //
    public function index()
    {
        return view ('admin.Product.index');      
    }
    public function getdata()
    {
        $product=product_category::get();
        return response()->json($product);
    }
    public function savedata(Request $request)
    {
            // Create a new employee
            $post = $request->post();
            $id=$request['hid'];
            if($request['hid']!="")
            {
                $request->validate([
                    'name' => 'required',
                    'status' => 'required',
                     // Ensure skills is an array
                ], [
                    'name.required' => 'The name field is required.',
                    'status.required' => 'The status field is required.',
                ]);   
                $update_about =  product_category::where("id", $id);
                $update_data = [
                    "name" => isset($post['name']) ? $post['name'] : "",
                    "status" => isset($post['status']) ? $post['status'] : "",
                         ];
                $update_about->update($update_data);
                return response()->json(['success' => true, 'message' => 'Category updated successfully!']);
                 
            }
        else{
            $request->validate([
                'name' => 'required',
                'status' => 'required',
                // Ensure skills is an array
            ], [
                'name.required' => 'The name field is required.',
                'status.required' => 'The status field is required.',
                
            ]);
            product_category::create([
                'name' => $request->name,
                'status' => $request->status,
               ]);
            return response()->json(['success' => true, 'message' => 'Category created successfully!']);
        }
    }
    public function deletedata(string $id)
    {
        $product=product_category::find($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully!']);
    }
    public function editdata(string $id)
    {  
        $product=product_category::find($id);
        return response()->json($product);
    }

}