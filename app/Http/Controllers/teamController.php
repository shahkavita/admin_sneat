<?php

namespace App\Http\Controllers;
use App\Models\team;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class teamController extends Controller
{
    //
    public function index()
    {
        return view('admin.Team.index');
    }
    public function list(Request $request)
    {
       if ($request->ajax()) {
            $data =team::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    return $data->created_at ? 
                    $data->created_at->format('d M Y').'<br>'.$data->created_at->format('h:i A') : '-';
                })
                ->addColumn('updated_at', function ($data) {
                    return $data->updated_at? $data->updated_at->format('d M Y').
                    '<br>'.$data->updated_at->format('h:i A') : '-';
                })
                ->addColumn('image', function ($data) {
                    return $data->image ? 
                    '<img src="' . asset('storage/' . $data->image) . '" style="width: 50px; height:50px; border-radius: 5px; object-fit: cover;" />' 
                    : 'No Image';
                })       
                ->addColumn('facebook', function ($data) {
                    return $data->facebook ? '<a href="' . $data->facebook . '" target="_blank"><i class="fab fa-facebook"  style="font-size:24px"></i>
</a>' : '-';
                })
                ->addColumn('twitter', function ($data) {
                    return $data->twitter ? '<a href="' . $data->twitter . '" target="_blank"><i class="fab fa-twitter" style="font-size:24px"></i></a>' : '-';
                })
                ->addColumn('skype', function ($data) {
                    return $data->skype ? '<a href="' . $data->skype . '" target="_blank"><i class="fab fa-skype" style="font-size:24px"></i></a>' : '-';
                })
                
                ->addColumn('action', function ($row) {
                return '<button class="edit btn btn-info btn-sm"  onclick="editteam('.$row->id.')"><i class="fas fa-edit"></i></button>
                        <button class="delete btn btn-danger btn-sm" onclick="deleteteam('.$row->id.')"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>';
                })
                ->rawColumns(['image','facebook','twitter','skype','created_at','updated_at','action'])
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
                $request->validate([
                    'name' => 'required',
                    'role' => 'required',
                    'facebook' => 'required|url',
                    'twitter' => 'required|url',
                    'skype' => 'required|url',   
                    // Ensure skills is an array
                ]);

                $team=team::find($id);
                if($request->hasFile('image'))
                {
                    $image_path=public_path("storage/").$team->image;
                    if(file_exists($image_path))
                    {
                        @unlink($image_path);
                    }
                    $path=$request->image->store('images/team','public');
                    $update_data=[
                        'name'=>isset($post['name']) ?$post['name']: "",
                        'role'=>isset($post['role']) ?$post['role']: "",
                        'image'=>$path,
                        'facebook'=>isset($post['facebook']) ?$post['facebook']: "",
                        'twitter'=>isset($post['twitter']) ?$post['twitter']: "",
                        'skype'=>isset($post['skype']) ?$post['skype']: "",
                    ];
                    $team->update($update_data);
                }
                else
                {
                    $update_data=[
                        'name'=>isset($post['name']) ?$post['name']: "",
                        'role'=>isset($post['role']) ?$post['role']: "",
                        'facebook'=>isset($post['facebook']) ?$post['facebook']: "",
                        'twitter'=>isset($post['twitter']) ?$post['twitter']: "",
                        'skype'=>isset($post['skype']) ?$post['skype']: "",
                   
                    ];
                    $team->update($update_data);
                }
                return response()->JSON(['success'=>true,'message'=>'Team Updated Successfully!!']);
            }
        
        else {
            $request->validate([
                    'name' => 'required',
                    'role' => 'required',
                    'image'=>'required',
                    'facebook' => 'required|url',
                    'twitter' => 'required|url',
                    'skype' => 'required|url', 
                // Ensure skills is an array
            ]);
            $imagePath = null;
           
            team::create([
                'name' => $request->name,
                'role'=>$request->role,
                'image'=>$request->file('image')->store('images/team','public'),
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'skype'=>$request->skype,
    
            ]);
            return response()->json(['success' => true, 'message' => 'Team created successfully!']);
        }
    }
    public function getdata(string $id)
    {
        $team = team::find($id);
        return response()->json($team);
    }
    public function deletedata(string $id)
    {
        $team= team::find($id);
        if ($team->image)
        {
            $image_path=public_path("storage/").$team->image;
            if(file_exists($image_path))
            {
                @unlink($image_path);
            }

        }
        
        $team->delete();
        return response()->json(['success' => true, 'message' => 'Team deleted successfully!']);
    }
}
