<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Models\Extensionistafornecedor;
use App\Models\Models\Role;
use App\Models\Models\Telefone;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role = Role::where('nome', 'cliente')->orWhere('nome', 'fornecedor')->orderBy('created_at', 'desc')->get();
        return view('auth.register', compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'numero' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'numero' => $request->numero,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        if($request->role_id === '9t243f2e-ef1e-4454-9ae2-34d091efbc8p')
        {
            Extensionistafornecedor::create([
                'extensionista_id' => 'h962bb71-3ccf-4994-9c60-0dba5f49a7y8',
                'users_id' => $user->id,
                'situacao_id' => '3gd66d9f-614f-8adc-994f-a578099e95j8'
            ]);
            $details = $request->all();
            Mail::to('admin@firsteducation.edu.mz')->send(new RegisterMail($details));
            Mail::to('extensionista@firsteducation.edu.mz')->send(new RegisterMail($details));
        } else {

        }
        /* Auth::login($user); */
        $input = $request->all();
        $input['users_id'] = $user->id;
        Telefone::create($input);

        if($user->role_id === '9t243f2e-ef1e-4454-9ae2-34d091efbc8p')
        {
            return redirect()->route('dashboard');
        } elseif ($user->role_id === '8f243f2e-ef1e-4454-9ae2-34d091efbc5t') {
            return redirect()->route('dashboard');
        }
        /* return redirect(RouteServiceProvider::HOME); */
    }
}
