<?php

namespace App\Livewire\Auth;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Siswa::where('email', $validated['email'])->exists()) {
            $validated['password'] = Hash::make($validated['password']);
            $validated['role'] = 'siswa'; // Set default role to 'siswa'

            $user = User::create($validated);
            $user->assignRole('siswa'); // Assign the 'siswa' role

            event(new Registered($user));
            Auth::login($user);

            $this->redirect(route('dashboard', absolute: false), navigate: true);
        } elseif (Guru::where('email', $validated['email'])->exists()) {
            $validated['password'] = Hash::make($validated['password']);
            $validated['role'] = 'guru'; // Set default role to 'siswa'

            $user = User::create($validated);
            $user->assignRole('guru'); // Assign the 'siswa' role

            event(new Registered($user));
            Auth::login($user);

            $this->redirect('/admin', navigate: true);
        } else {
            $this->addError('email', 'Email tidak terdaftar sebagai siswa.');
        }
    }
}
