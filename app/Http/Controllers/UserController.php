<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Get one user
    public function show(User $user)
    {
        if ($user->id === null) {
            $user = auth()->user();
        }

        return view('user.show', [
            'user' => $user
        ]);
    }

    // Show login form
    public function login()
    {
        return view('user.login');
    }

    // Log user in
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Byli jste přihlášeni!')->with('color', 'success');
        }

        return back()->withErrors(['email' => 'Chybně jste zadali email nebo heslo.']);
    }

    // Log user out
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Byli jste odhlášeni!')->with('color', 'success');
    }

    // Show create form
    public function create()
    {
        return view('user.create');
    }

    // Store user data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Log user in
        auth()->login($user);

        return redirect('/ucet')->with('message', 'Váš účet byl úspěšně vytvořen!')->with('color', 'success');
    }
}
