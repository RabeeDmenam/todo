<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\todo;

class todoController extends Controller
{


   public function __construct(){

          $this->middleware('AdminAuth',['except' => ['index']]);
   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     // $userlogin = Admin::where('id', auth('admin')->user()->id);
        $userlogin = auth('admin')->user()->id ;
        dd($userlogin);

        $data = todo::join('admins','admins.id','=','todo.added_by')->select('todo.*','admins.email')->orderBy('id','desc')->get();

        return view('todo.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('todo.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //['title','description','added_by','startdate','enddate','updated_at','created_at','image'];

        $data = $this->validate(request(),
           [
               "title"   => "required|min:5",
               "description" => "required|min:30",
               "startdate" => "required",
               "enddate" => "required",
               "image"   => "required|image|mimes:png,jpg,gif,svg"
           ]);

           $FinalName = time().rand().'.'.$request->image->extension();

           # public folder
            if($request->image->move(public_path('todoImages'),$FinalName)){

              $data['image'] = $FinalName;
              $data['added_by'] = auth('admin')->user()->id;

              $op =  todo::create($data);

              if($op){
                  $message = "Raw Inserted";
              }else{
                  $message = "Error Try Again";
              }

            }else{
                $message = "Error In Uploading Try Again";
            }

             session()->flash('Message',$message);

             return redirect(url('/todo'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //



          dd('show method');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $data = todo::find($id);
         return view('todo.edit',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        dd($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

//
//        $data•=-todo: :find ($id):
//•if(strtotime($data[*enddate'])-›-strtotime$request-›enddate)
//-Sop- -= -todo: :where('id, $id) -›delete():
//- if
    $data = todo::find($id);

       if ($data['enddate'] < date()){

         $op = todo::where('id',$id)->delete();

          if($op){

             unlink(public_path('todo/'.$data->image));

              $message = "Raw Removed";
          }else{
              $message = "Errot Try Again";
          }

          session()->flash('Message',$message);

          return redirect(url('/Blog'));

    }else{
           $message = "task expired";
       }

    }
}
