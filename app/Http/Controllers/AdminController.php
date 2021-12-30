<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;

use App\Models\todo;

class AdminController extends Controller
{
    //php artisan make:controller name ...


  public function index(){

    //   if(auth()->check()){

     $data =   Admin::join('todo','admins.id','=','todo.id')->select('admins.*','todo.title')->get();
    //leftjoin , rightjoin ....

     return view('Users.index',['data' => $data]);

    //   }else{
    //       return redirect(url('/Login'));
    //   }

  }



  public function create(){

    # Fetch Department Data ....
    $data = todo::get();

    return view('Users.create',['todo' => $data]);
  }


   public function store(Request $request){

         # Validate Data .....
       $data =   $this->validate($request,[

             "password" => "required|min:6|max:50",
             "email"    => "required|email",

         ]);


          $data['password'] =  bcrypt($data['password']);

     $op =   Admin::create($data);

      if($op){
          $message = "Raw Inserted .";
            }else{
          $message = 'Error Try Again !';
      }

       session()->flash('Message',$message);
        return redirect(url('/Users'));

   }





    public function edit($id){

           $data = Admin::find($id);

           $dep_data = todo::get();

        return view('Users.edit',['data' => $data]);
    }




    public function update(Request $request){
      // code ......

          # Validate Data .....
          $data =   $this->validate($request,[
             "name"     => "required|min:3",
             "email"    => "required|email",
             "id"       => "required|numeric",

         ]);

       $op =   Admin::where('id',$request->id)->update($data);

       if($op){
           $message = "Raw Updated";
       }else{
           $message = "Error Try Again";
       }

       session()->flash('Message',$message);

       return redirect(url('/Users'));



    }




     // delete item .....

     public function destroy($id){
      // code ....
     $op  =  Admin::where('id',$id)->delete();    //  where([['id' => $id],['name' => $name]])

     if($op){
         $message = "Raw Removed";
     }else{
         $message = "Error Try Again";
     }
     session()->flash('Message',$message);
     return redirect(url('/Users'));
    }


  # Auth .....


  public function Login(){
      return view('Users.login');
  }



  public function DoLogin(Request $request){
      // logic .....

      $data = $this->validate($request,[
          "email"    => "required|email",
          "password" => "required|min:6"
      ]);

//auth()->guard('admin')->attempt($data)
    if(auth('admin')->attempt($data)){
        return redirect(url('/Users'));
    }else{
        return redirect('/Login');
    }

  }



  public function logout(){
      auth('admin')->logout();
      return redirect(url('/Login'));
  }








//    public function UserInfo(){
//        // code .....

//        $details = ["Name" => "Root Account" , "Age" => 20 , "Grade" => 3.4 , "Level" => 2];

//        $city = ['Cairo','Giza','Alex'];

//      //   return view('userDetails',["data" => $details , 'cities' => $city]);
//     //    return view('userDetails')->with('data',$details)->with('cities',$city);
//    //     return view('userDetails')->with(["data" => $details , 'cities' => $city]);
//           return view('userDetails',compact('details','city'));

// }


}
