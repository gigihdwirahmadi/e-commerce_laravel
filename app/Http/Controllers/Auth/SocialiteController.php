<?php

namespace App\Http\Controllers\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Throwable;

class SocialiteController extends Controller
{

    public function redirectToProvider($provider)
    
    {
       
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        if(Auth::user()->role=='admin') {
            return redirect(Route('admin.dashboard'));
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->getId())->first();
        if ($authUser) {
            return $authUser;
        } else {
            // dd($provider,$user->id);
            // $data = User::create([
            //     'name'     => $user->name,
            //     'email'    => !empty($user->email) ? $user->email : '',
            //     'password'    => "",
            //     'provider' => $provider,
            //     'provider_id' => $user->id,
            //     'role' => 'admin',
            // ]);
            $date = now();
            $data = DB::insert('insert into users (name, email, password, provider, provider_id, role,email_verified_at, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$user->getName(),$user->getEmail(),"",$provider, $user->id,'user', $date, $date, $date]);
            // try{
        //   $update = User::find( $data->id)->update([
           
        //   ]);
        // }catch(Throwable $th ){
        //     echo $th;
        // }
        $authUser = User::where('provider_id', $user->getId())->first();
        return $authUser;
        
    }
}
}