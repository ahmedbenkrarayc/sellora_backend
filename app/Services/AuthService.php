<?php

namespace App\Services;

use App\Repositories\Interfaces\IAuthRepository;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Str;

class AuthService
{
    private $authRepository;

    public function __construct(IAuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }

    public function register(array $data){
        $data['password'] = Hash::make($data['password']);
        $user = $this->authRepository->createUser($data);
        if($user->role === 'customer'){
            Customer::create([
                'id' => $user->id,
                'store_id' => $store_id
            ]);
        }

        return $user;
    }

    public function login(array $credentials){
        if(!$token = JWTAuth::attempt($credentials)){
            return ['error' => 'Unauthorized'];
        }

        $refreshToken = JWTAuth::fromUser(auth()->user(), ['refresh' => true]);

        return $this->generateTokens($token, $refreshToken);
    }

    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        JWTAuth::invalidate(JWTAuth::getToken(), true);

        return ['message' => 'Logged out successfully'];
    }

    public function refresh(string $refreshToken){
        try{
            JWTAuth::setToken($refreshToken);
            $newAccessToken = JWTAuth::refresh();

            return $this->generateTokens($newAccessToken, $refreshToken);
        }catch(\Exception $e){
            return ['error' => 'Invalid or expired refresh token'];
        }
    }

    public function forgotPassword(string $email){
        $user = $this->authRepository->findUserByEmail($email);

        if(!$user){
            return ['error' => 'User not found'];
        }

        $resetToken = Str::random(6);
        $expiresAt = Carbon::now()->addMinutes(15);

        $this->authRepository->updateResetToken($user, $resetToken, $expiresAt);

        Mail::raw("Your password reset code is: $resetToken", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset Code');
        });

        return ['message' => 'Reset code sent to email'];
    }

    public function resetPassword(string $email, string $resetToken, string $newPassword){
        $user = $this->authRepository->findUserByEmail($email);

        if(!$user || $user->reset_token !== $resetToken || Carbon::now()->gt($user->reset_token_expires_at)){
            return ['error' => 'Invalid or expired reset token'];
        }

        $this->authRepository->updatePassword($user, $newPassword);

        return ['message' => 'Password reset successfully'];
    }

    private function generateTokens($token, $refreshToken){
        return [
            'message' => 'Authenticated',
            'user' => auth()->user(),
            'token' => $token,
            'refresh_token' => $refreshToken
        ];
    }
}
