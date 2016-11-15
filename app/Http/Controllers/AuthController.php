<?php

namespace App\Http\Controllers;

use Adldap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class AuthController extends Controller
{
    
    public function getHome(){
        return view('login');
    }

    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        $email = $request['email'];
        $user = explode('@', $email);
        if(!($user[1] == 'kemenkeu.go.id')){
            return redirect()->back();
        }
        $username = $user[0];
        $password = $request['password'];
        
        //bila login ke AD
        if (Adldap::auth()->attempt($username, $password )){
            //bisa login local, check AD untuk nama dan jabatan
            if(Auth::attempt(['username' => $username, 'password' => $password])){
                $info = $this->connectLDAP($email, $password);

                $longname = $info[0]['cn'][0];
                $jabatan =  $info[0]['title'][0];

                $userExist = User::where('username',$username)->first();
                //jika nama dan jabatan tidak sama
                if($userExist->longname !== $longname || $userExist->jabatan !== $jabatan){
                    $userExist->longname = $longname;
                    $userExist->jabatan = $jabatan;
                    if(strpos($jabatan, 'Kepala Pusat') !== false || strpos($jabatan, 'Kepala Bidang') !== false || strpos($jabatan, 'Kepala Subbidang') !== false){
                        $userExist->isAdmin = 1;
                    } else {
                        $userExist->isAdmin = 0;
                    }
                    $userExist->update();
                }

                return redirect()->route('report');
            //jika password berbeda, sekalian update nama dan jabatan
            } elseif(!Auth::attempt(['username' => $username, 'password' => $password])){
                $info = $this->connectLDAP($email, $password);

                $longname = $info[0]['cn'][0];
                $jabatan =  $info[0]['title'][0];

                $userExist = User::where('username',$username)->first();
                
                if($userExist){
                    $userExist->longname = $longname;
                    $userExist->jabatan = $jabatan;
                    $userExist->password = bcrypt($password);
                    $userExist->update();
                //else jika ga ada sama sekali di local
                } else {
                    $info = $this->connectLDAP($email, $password);

                    $longname = $info[0]['cn'][0];
                    $jabatan =  $info[0]['title'][0];

                    $user = new User();
                    $user->username = $username;
                    $user->longname = $longname;
                    $user->jabatan = $jabatan;
                    $user->email = $email;
                    if(strpos($jabatan, 'Kepala Pusat') !== false || strpos($jabatan, 'Kepala Bidang') !== false || strpos($jabatan, 'Kepala Subbidang') !== false){
                        $user->isAdmin = 1;
                    }
                    $user->password = bcrypt($password) ;
                    $user->save();
                }

                Auth::attempt(['username' => $username, 'password' => $password]);
                return redirect()->route('report'); 
                
            }
            
        } else {
            return redirect()->route('login');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function connectLDAP($email, $password){
        $adServer = "kemenkeu.go.id";
        $ldap = ldap_connect($adServer);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($ldap, $email, $password);

        $filter = "(mail=$email)";
        $justthese = array("cn", "title");
        $result = ldap_search($ldap, "ou=kemenkeu,dc=kemenkeu,dc=go,dc=id",$filter, $justthese) or die ("Error : ".ldap_error($bind));
        $info=ldap_get_entries($ldap, $result);

        return $info;
    }
}
