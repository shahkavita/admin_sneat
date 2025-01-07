<?php

namespace App\Http\Controllers;
use App\Models\demo;
use Illuminate\Http\Request;
use DataTables;
class demoController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = demo::select('*');

            return Datatables::of($data)

                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        $statusClass = $row->status == 'active' ? 'btn-success' : 'btn-danger';
                       if($row->status == 0)
                       {
                        return "<button class='btn btn-danger'>Inactive</button>";
                       } 
                       else
                       {
                        return "<button class='btn btn-success'>Active</button>";
                       }
          

                })
                    ->addColumn('action', function($row){
                            $btn = '<button name="editcategory" id="editcategory" class="btn btn-primary btn-sm">Edit</button>
                                    <button name="deletecategory" id="deletecategory" class="btn btn-danger btn-sm">Delete</button>';
                            return $btn;

                    })
                    ->rawColumns(['status','action'])
                    ->make(true);

        }     
        return view('admin.product.demo');

    }
    public function get()
    {
        $demo=demo::get();
        return $demo;
    }
}
