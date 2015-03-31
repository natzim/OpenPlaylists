<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard     $auth
     * @param Registrar $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', [
            'except' => 'getLogout'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('name', 'remember'))
            ->withErrors([
                'name' => $this->getFailedLoginMessage(),
            ]);
    }

}
