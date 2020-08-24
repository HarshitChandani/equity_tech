<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Home extends Controller{
   /**
    * List of all signUp users
    * Use Query Builder instead of Model Class
    */
   public function index(){
      if(Auth::check()):
         $users = array();       // user storage
         (Integer)$count = 0;
         $fetching_process = DB::table("users")->get();
         foreach($fetching_process as $fp):
            $users[$count]["name"]  = $fp->name;
            $users[$count]["parent_id"]   = $fp->parent_id;
            $users[$count]["email"] = $fp->email;
            $count = $count + 1;
         endforeach;
         return view("auth.home",["users"=>$users]);
      else:
         return redirect("/");
      endif;
   }
   /**
    * Remove Operation 
    */
   public function remove(Request $request){
      if($this->check_authention()):
         $user_number = $request->input("user_number");
         $if_exists = DB::table("users")->where("parent_id","=",$user_number)->exists();     // if parent_id of user exists (Optional Statement)
         if($if_exists == 1 || $if_exists== true):                                           // if yes
            $total_rows = DB::table("users")->count();                                       // count total rows in db
            if($total_rows > 1):                                                             // if rows are >1
              User::where("parent_id",$user_number)->delete();            // normal deletion process
            else:                                                                                   
              DB::table("users")->truncate();                             // truncate the whole table 
            endif;
         endif;
         return redirect()->back();                                                          // redirect back to the home page
      else:
         return redirect("/");
      endif;
   }

   function update(Request $request){
      $parent_id = $request->input("user_number");
      $fetch_specfic_user = DB::table("users")->where("parent_id","=",$parent_id)->get();
      $Specfic_user = array();
      foreach($fetch_specfic_user as $fsu):
         $Specfic_user["name"]   = $fsu->name;
         $Specfic_user["email"]  = $fsu->email;
         $Specfic_user["parent_id"] = $fsu->parent_id;
      endforeach;
      return view("auth.update",["user"=>$Specfic_user]);
   }
   /**
    * Update Operation on user details
    */
   public function edit(Request $request){
      if($this->check_authention()):
         $flag = 0;
         $this->check_validation($request);
         $parent_id = $request->input('hidden_parent');
         $name = $request->input('name');
         $new_email = $request->input("email");
         $new_password = $request->input("password");
            /**
             * to create the uniqueness of the emails at the time of Updation Process 
             * Process Start
             */
         $fetch_rows = DB::table("users")->where("parent_id","!=",$parent_id)->get();        
         foreach($fetch_rows as $email_row){
            $old_email = $email_row->email;
            if($old_email == $new_email){
               $email_existed = "Error is already taken by other user";    
               $flag = 1;
               break;
            }
         }
         /**
          * Process End
          */
         if($flag == 1){
            return redirect()->back()->withErrors(["email"=>$email_existed])->withInput();
         }
         else{
            if(User::where("parent_id",$parent_id)->update(["name"=>$name,"email"=>$new_email,"password"=>Hash::make($new_password)])):
               return redirect()->route("home");
            endif;
         }
      else:
         return redirect("/");
      endif;
   }


   /**
    * Check Authentication of User
    */
   protected function check_authention(){
      if(Auth::check()){
         return true;
      }
      else{
         return false;
      }
   }

   /**
    * Validations Check
    */
   protected function check_validation(Request $request){
      return Validator::make($request->all(),[
         "name"   =>"required|max:255",
         "email"  =>"required|max:255|email",
         "password"=>"required|string",
      ])->validate();
   }
}

?>