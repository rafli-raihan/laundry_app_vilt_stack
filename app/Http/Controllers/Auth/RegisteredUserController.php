<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Level;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        return Inertia::render('accounts/Index', compact('users'));
    }
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        $levels = Level::orderBy("id", "desc")->get();
        return Inertia::render('accounts/Register', compact('levels'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_level' => 'required|integer|exists:levels,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'id_level' => $request->id_level,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user)); ini nanti klo mau buat ada notifikasi pas register

        return to_route('acc_index');
    }

    public function edit(User $user)
    {
        $levels = Level::orderBy("id", "desc")->get();
        return Inertia::render('accounts/Edit', compact('user', 'levels'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'id_level' => 'required|integer|exists:levels,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class . ',email,' . $user->id,
        ]);

        $user = $user->update([
            'id_level' => $request->id_level,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return to_route('acc_index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return to_route('acc_index');
    }
}
