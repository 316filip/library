<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\UserHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Show user
     * 
     * @return object
     */
    public function show($user = "")
    {
        $user = UserHelper::find($user);

        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show login form
     * 
     * @return object
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * Log user in
     * 
     * @return object
     */
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        $remember = $request->remember == 'on' ? 1 : 0;

        if (auth()->attempt($formFields, $remember)) {
            $request->session()->regenerate();

            return redirect('/knihovna')->with('message', 'Byli jste přihlášeni!')->with('color', 'success');
        }

        return back()->withErrors(['email' => 'Chybně jste zadali email nebo heslo.']);
    }

    /**
     * Log user out
     * 
     * @return object
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Byli jste odhlášeni!')->with('color', 'success');
    }

    /**
     * Show create form
     * 
     * @return object
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store user data
     * 
     * @return object
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Generate code
        $formFields['code'] = uniqid();

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Log user in
        auth()->login($user);

        return redirect('/ucet')->with('message', 'Váš účet byl úspěšně vytvořen!')->with('color', 'success');
    }

    /**
     * Show edit form
     * 
     * @return object
     */
    public function edit($user = "")
    {
        $user = UserHelper::find($user);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update user data
     * 
     * @return object
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->librarian && ($user->id !== auth()->user()->id)) {
            return redirect('/ucet')->with('message', 'Nemáte oprávnění upravovat tohoto uživatele!')->with('color', 'fail');
        }

        $link = '/ucet';
        if ($user->id !== auth()->user()->id) {
            $link = '/ucet/' . $user->code;
        }

        if ($request->type == 'data') {
            $formFields = $request->validate([
                'first_name' => ['required', 'min:3'],
                'last_name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
            ]);

            if (count(User::where('email', $formFields['email'])->where('id',  '!=', $user->id)->get()) !== 0) {
                return back()->withErrors(['email' => 'Tuto emailovou adresu již používá někdo jiný.']);
            }

            $user->update([
                'first_name' => $formFields['first_name'],
                'last_name' => $formFields['last_name'],
                'email' => $formFields['email'],
            ]);

            return redirect($link)->with('message', 'Uživatelský profil byl úspěšně aktualizován!')->with('color', 'success');
        } elseif ($request->type == 'password') {
            $formFields = $request->validate([
                'password_old' => 'required',
                'password' => ['required', 'confirmed', 'min:6'],
            ]);

            if (!Hash::check($formFields['password_old'], $user->password)) {
                return back()->withErrors(['password_old' => 'Chybně jste zadali současné heslo.']);
            }

            $user->update([
                'password' => bcrypt($formFields['password']),
            ]);

            return redirect($link)->with('message', 'Heslo bylo úspěšně změněno!')->with('color', 'success');
        } elseif ($request->type == 'competency') {
            if (!auth()->user()->admin) {
                return back()->with('message', 'Nemáte oprávnění upravovat tohoto uživatele!')->with('color', 'fail');
            }

            $formFields = $request->validate([
                'admin' => 'nullable',
                'librarian' => 'nullable',
            ]);

            if (isset($formFields['admin']) && $formFields['admin'] == 1) {
                $formFields['admin'] = true;
            } else {
                $formFields['admin'] = false;
            }

            if (isset($formFields['librarian']) && $formFields['librarian'] == 1) {
                $formFields['librarian'] = true;
            } else {
                $formFields['librarian'] = false;
            }

            if ($formFields['admin'] === true && $formFields['librarian'] !== true) {
                return back()->with('message', 'Aby byl uživatel správce, musí být i knihovník!')->with('color', 'fail');
            }

            $user->update([
                'admin' => $formFields['admin'],
                'librarian' => $formFields['librarian'],
            ]);

            return redirect($link)->with('message', 'Oprávnění byla úspěšně použita!')->with('color', 'success');
        }
    }

    /**
     * Show new password request form
     * 
     * @return object
     */
    public function request_password()
    {
        return view('users.request');
    }

    /**
     * Send password reset email
     * 
     * @return object
     */
    public function email_password(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($formFields);

        $color = $status == 'passwords.sent' ? 'success' : 'fail';

        return redirect('/prihlaseni')->with('message', __($status))->with('color', $color);
    }

    /**
     * Show password reset form
     * 
     * @return object
     */
    public function reset_password(Request $request)
    {
        return view('users.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    /**
     * Update password data
     * 
     * @return object
     */
    public function update_password(Request $request)
    {
        $formFields = $request->validate([
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $status = Password::reset($formFields, function (User $user, string $password) {
            $user->forceFill([
                'password' => $password,
            ])->setRememberToken(Str::random(60));

            $user->save();
        });

        $color = $status == 'passwords.reset' ? 'success' : 'fail';

        return redirect('/prihlaseni')->with('message', __($status))->with('color', $color);
    }

    /**
     * Delete user
     * 
     * @return object
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->librarian && ($user->id !== auth()->user()->id)) {
            return redirect('/ucet')->with('message', 'Nemáte oprávnění odstranit tohoto uživatele!')->with('color', 'fail');
        }

        if (!auth()->user()->admin && ($user->admin || $user->librarian)) {
            return back()->with('message', 'Nemáte oprávnění odstranit tohoto uživatele!')->with('color', 'fail');
        }

        $user->delete();
        return redirect('/')->with('message', 'Účet byl úspěšně odstraněn!')->with('color', 'success');
    }
}
