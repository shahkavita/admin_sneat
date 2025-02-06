<?php

namespace App\Http\Controllers;

use App\Models\product_category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class productcategoryController extends Controller
{
    //
    public function index()
    {
       // return view('admin.Product.democategory');
       return view('admin.Product.index');
    }
    public function list(Request $request)
    {
       if ($request->ajax()) {
            $data = product_category::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    $statusClass = $row->status == 'active' ? 'btn-success' : 'btn-danger';
                   if($row->status == 0)
                   {
                    return "<button class='btn btn-dark btn-sm'>Inactive</button>";
                   } 
                   else
                   {
                    return "<button class='btn btn-primary btn-sm'>Active</button>";
                   }
                })
                ->addColumn('action', function ($row) {
                return '<button class="edit btn btn-info btn-sm"  onclick="editcategory('.$row->id.')"><i class="fas fa-edit"></i></button>
                        <button class="delete btn btn-danger btn-sm" onclick="deletecategory('.$row->id.')"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }

    public function getdata()
    {
        $product = product_category::get();
        return response()->json($product);
    }
    public function savedata(Request $request)
    {
        // Create a new employee
        $post = $request->post();
        $id = $request['hid'];
        if ($request['hid'] != "") {
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
        } else {
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
        $product = product_category::find($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully!']);
    }
    public function editdata(string $id)
    {
        $product = product_category::find($id);
        return response()->json($product);
    }
}
