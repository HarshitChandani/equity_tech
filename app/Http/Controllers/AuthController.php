<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller{
   
   public function register(){
      return view("auth.signup");
   }

   /**
    * user's login function after checking validations
    */
   public function login(Request $request){
      if($request->isMethod("POST")):
         $this->validation($request)->validate();
         $set_credentails = $request->only("email","password");
         if(Auth::attempt($set_credentails)):
            if(Auth::check()):
               return redirect()->route("home");
            endif;
         else:
            return redirect()->back()->withErrors(["email"=>"Credentials do not match out records"])->withInput();
         endif;
      endif;
   }
   /**
    * Validations for Login Process
    */
   protected function validation(Request $request){
      return Validator::make($request->all(),[
         "email" => "required|max:255|email",
         "password"=>"required|string"
      ]);
   }
   public function signup(Request $request){
      if($request->isMethod("POST")):
         $parent_uniquer_id = Str::uuid()->toString();
         $user = User::create([
            "parent_id" => $parent_uniquer_id,
            "name"      => $request->name,
            "email"     => $request->email,
            "password" =>  Hash::make($request->password)
         ]);
         /**
         * auto login after registration
         */
         if(Auth::loginUsingId($user->id)){
            return redirect()->route("home");
         }
      endif;
   }
   /**
    * logout if user is Authenticated
    */
   public function logout(Request $request){
      if(Auth::check()):                           // if user is logged in
         $request->session()->invalidate();        // create new session ID and flush old session ID
         $request->session()->regenerateToken();   // generate new CSRF token key 
         Auth::logout();                           // logout using AUTH class
         return redirect("/");

      endif;
   }
}

?>