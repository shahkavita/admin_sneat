<?php

namespace App\Http\Controllers;
use App\Models\product_category;
use App\Models\product;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class productController extends Controller
{
    //
    public function index()
    {
        $category=product_category::where('status','1')->get();
        return view('admin.Product.productindex',compact('category'));
    }
    public function list(Request $request)
    {
       if ($request->ajax()) {
            $data =product::with('category')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($data) {
                    return $data->category ? $data->category->name : 'No Category';
                }) 
                ->addColumn('image', function ($data) {
                    return $data->p_image ? 
                    '<img src="' . asset('storage/' . $data->p_image) . '" style="width: 70px; height:70px; border-radius: 5px; object-fit: cover;" />' 
                    : 'No Image';
            
                })
                ->addColumn('description', function ($data) {
                    return $data->p_des ? $data->p_des : 'No Description';
                })
                      
                ->addColumn('p_status', function($row){
                    $statusClass = $row->p_status == 'active' ? 'btn-success' : 'btn-danger';
                   if($row->p_status == 0)
                   {
                    return "<button class='btn btn-dark btn-sm'>Inactive</button>";
                   } 
                   else
                   {
                    return "<button class='btn btn-primary btn-sm'>Active</button>";
                   }
                })
                ->addColumn('action', function ($row) {
                return '<button class="edit btn btn-info btn-sm"  onclick="editproduct('.$row->p_id.')"><i class="fas fa-edit"></i></button>
                        <button class="delete btn btn-danger btn-sm" onclick="deleteproduct('.$row->p_id.')"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>';
                })
                ->rawColumns(['image','description','category_name','p_status','action'])
                ->make(true);
            }
    }
    public function savedata(Request $request)
    {
        // Create a new employee
        $post = $request->post();
        $id = $request['hid'];
      
            if($request['hid']!="")
            {
                $product=product::find($id);
                if($request->hasFile('image'))
                {
                    $image_path=public_path("storage/").$product->p_image;
                    if(file_exists($image_path))
                    {
                        @unlink($image_path);
                    }
                    $path=$request->image->store('images/product','public');
                    $update_data=[
                        'p_name'=>isset($post['name']) ?$post['name']: "",
                        'p_des'=>isset($post['description']) ?$post['description']: "",
                        'p_price'=>isset($post['price']) ?$post['price']: "",
                        'p_status'=>isset($post['status']) ?$post['status']: "",
                        'category_id'=>isset($post['category']) ?$post['category']: "",
                        'p_image'=>$path,
                    ];
                    $product->update($update_data);
                }
                else
                {
                    $update_data=[
                        'p_name'=>isset($post['name']) ?$post['name']: "",
                        'p_des'=>isset($post['description']) ?$post['description']: "",
                        'p_price'=>isset($post['price']) ?$post['price']: "",
                        'p_status'=>isset($post['status']) ?$post['status']: "",
                        'category_id'=>isset($post['category']) ?$post['category']: "",
                   
                    ];
                    $product->update($update_data);
                }
                return response()->JSON(['success'=>true,'message'=>'Product Updated Successfully!!']);
            }
        
        else {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required',
                'category' => 'required',
                'status' => 'required',
                // Ensure skills is an array
            ], [
                'p_name.required' => 'The Name field is required.',
                'p_price.required' => 'The Price field is required.',
                'p_des.required' => 'The Description field is required.',
                'p_image.required' => 'The Image field is required.',
                'category_id.required' => 'The Category field is required.',
                'p_status.required' => 'The status field is required.',

            ]);
            $imagePath = null;
           
            product::create([
                'p_name' => $request->name,
                'p_price'=>$request->price,
                'p_image'=>$request->file('image')->store('images/product','public'),
                'p_des'=>$request->description,
                'category_id'=>$request->category,
                'p_status' => $request->status,
            ]);
            return response()->json(['success' => true, 'message' => 'Product created successfully!']);
        }
    }
    public function getdata(string $id)
    {
        $product = product::find($id);
        return response()->json($product);
    }
    public function deletedata(string $id)
    {
        $product = product::find($id);
        if ($product->p_image) {
            $imagePath = public_path('images/produts' . $product->p_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully!']);
    }
}
