<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AuthonticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check() ){
          {
            $user = Auth::user();
      $user_type = $user->type;
            if($user_type == 'admin'){
              $response =$next($request);
              return $response->header('Cache-Control','nocache,no-store,max-age=0,must-revalidate')
        ->header('Pragma','no-cache')
        ->header('Expires','Fri,01 Jan 1990 00:00:00 GMT');
            }
            else{
              return redirect('/editor');
            }

          }

        }

      else
        return redirect('/login');



  }

}
