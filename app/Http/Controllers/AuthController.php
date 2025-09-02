<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            Log::info('Register request data:', $request->all());

            if ($request->role === 'admin' && User::where('role', 'admin')->exists()) {
                Log::warning('Attempt to register second admin');
                return redirect()->route('register')->withErrors(['role' => 'Admin already exists']);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:admin,user',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            $token = JWTAuth::fromUser($user);
            session(['jwt_token' => $token]);
            Log::info('User registered and token stored:', ['user_id' => $user->id, 'role' => $user->role]);

            return redirect()->route('login')->with('success', 'Registration successful!');
        } catch (JWTException $e) {
            Log::error('Registration failed: Could not create token: ' . $e->getMessage());
            return redirect()->route('register')->withErrors(['error' => 'Registration failed: Could not create user token.']);
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return redirect()->route('register')->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function login(Request $request)
    {
        try {
            Log::info('Login request data:', $request->all());

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Attempt authentication
            if (!$token = JWTAuth::attempt($credentials)) {
                Log::warning('Login failed: Invalid credentials', ['email' => $request->email]);
                return redirect()->route('login')
                    ->withErrors(['error' => 'Invalid email or password'])
                    ->withInput($request->only('email'));
            }

            // Get authenticated user
            $user = JWTAuth::user();
            if (!$user) {
                Log::error('Login failed: No user found after JWT authentication');
                return redirect()->route('login')
                    ->withErrors(['error' => 'Authentication failed'])
                    ->withInput($request->only('email'));
            }

            // Store token in session
            session(['jwt_token' => $token]);
            Log::info('User logged in successfully:', ['user_id' => $user->id, 'role' => $user->role]);

            // Set user in auth
            auth('api')->setUser($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            }

            return redirect()->route('dashboard.user')->with('success', 'Login successful!');
        } catch (JWTException $e) {
            Log::error('Login failed: JWT error - ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['error' => 'Could not authenticate. Please try again.'])
                ->withInput($request->only('email'));
        } catch (\Exception $e) {
            Log::error('Login failed: General error - ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.'])
                ->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            session()->forget('jwt_token');
            Log::info('User logged out');
            return redirect()->route('home')->with('success', 'Successfully logged out');
        } catch (JWTException $e) {
            Log::error('Logout failed: ' . $e->getMessage());
            return redirect()->route('home')->withErrors(['error' => 'Failed to logout']);
        }
    }
}
