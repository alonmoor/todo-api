<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Task;
use App\Models\TaskUser;
use Validator;
//use DataTables;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Sample_data::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $x = 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'user_id'    =>  'required',
            'task_id'     =>  'required'
        );
       $task_id = $request->task_id_hidden;

       $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'user_id'        =>  $request->user_id,
            'task_id'         =>  $request->task_id
        );

        Sample_data::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }







//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index(Request $request)
//    {
//        if($request->ajax())
//        {
//            $data = Sample_data::latest()->get();
//            return DataTables::of($data)
//                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
//                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
//                    return $button;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//        return view('sample_data');
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $x = 1;
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $rules = array(
//            'first_name'    =>  'required',
//            'last_name'     =>  'required'
//        );
//
//        $error = Validator::make($request->all(), $rules);
//
//        if($error->fails())
//        {
//            return response()->json(['errors' => $error->errors()->all()]);
//        }
//
//        $form_data = array(
//            'first_name'        =>  $request->first_name,
//            'last_name'         =>  $request->last_name
//        );
//
//        Sample_data::create($form_data);
//
//        return response()->json(['success' => 'Data Added successfully.']);
//
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\User $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $sample_data)
//    {
//        $x = 1;
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        if(request()->ajax())
//        {
//            $data = Sample_data::findOrFail($id);
//            return response()->json(['result' => $data]);
//        }
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Sample_data $sample_data)
//    {
//        $rules = array(
//            'first_name'        =>  'required',
//            'last_name'         =>  'required'
//        );
//
//        $error = Validator::make($request->all(), $rules);
//
//        if($error->fails())
//        {
//            return response()->json(['errors' => $error->errors()->all()]);
//        }
//
//        $form_data = array(
//            'first_name'    =>  $request->first_name,
//            'last_name'     =>  $request->last_name
//        );
//
//        Sample_data::whereId($request->hidden_id)->update($form_data);
//
//        return response()->json(['success' => 'Data is successfully updated']);
//
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $data = Sample_data::findOrFail($id);
//        $data->delete();
//    }






















//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $x =1;
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $x =1;
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $user = User::create([ //dont need the save method -> pass an array in the model
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'password' => $request->input('password')
//           ]);
//
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //$users = User::all();
//        $user = User::find($id);
//    //    var_dump($user->tasks);
//        return view('users.edit')->with('user',$user);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $x =1;
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//   {
//       $x =1;
//
////        $user = User::where('id', $id)->update([ //dont need the save method -> pass an array in the model
////            'name' => $request->input('name'),
////            'founded' => $request->input('founded'),
////            'description' => $request->input('description')
////        ]);
////
////        return redirect('/cars');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $x =1;
//    }



//
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $users = User::latest()->paginate(5);
//        return view('users.index',compact('users'))->with('i',(request()->input('page',1)-1)*5);
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        return view('users.create');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
////        $request->validate([
////            'name' => 'required',
////            'description' => 'required',
////        ]);
//
//    //    User::create($request->all());
//
//
//            $user = User::create([
//            'task_id' => $request->input('task_id_hidden'),
//            'user_id' => $request->input('user_checkbox')
//            //'password' => $request->input('password')
//           ]);
//
//
//        return redirect()->route('users.index')
//            ->with('success','User created successfully.');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $user)
//    {
//        return view('users.show',compact('user'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(User $user)
//    {
//        return view('users.edit',compact('user'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, User $user)
//    {
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//        ]);
//
//        $user->update($request->all());
//
//        return redirect()->route('users.index')
//            ->with('success','User updated successfully');
//    }
//
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(User $user)
//    {
//        $user->delete();
//
//        return redirect()->route('users.index')
//            ->with('success','Users deleted successfully');
//    }












}
