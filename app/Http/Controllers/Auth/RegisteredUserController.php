<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedRequest = $request->validate($this->rules());

        $payload = array_merge($validatedRequest, ['password' => Hash::make($request->password)]);

        $user = Lecturer::create($payload);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME());
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:lecturers'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'university' => ['required', 'string', 'max:255'],
            'faculty' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255']
        ];
    }
}
