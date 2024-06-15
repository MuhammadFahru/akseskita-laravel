<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->api_response_validator('Periksa data yang anda isi!', [], $validator->errors()->toArray());
            }

            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = Auth::user();

                if (!$user->is_verified) {
                    return $this->api_response_error('Akun anda belum terverifikasi.', [], ['Akun anda belum terverifikasi.']);
                }

                $response_data = User::generateUserToken($user);

                if (isset($response_data['status']))
                    return $this->api_response_error($response_data['error']);

                return $this->api_response_success('Login berhasil.', $response_data);
            } else {
                return $this->api_response_error('Email atau password salah', [], ['Email atau password salah'], 419);
            }
        } catch (\Throwable $th) {
            return $this->api_response_error($th->getMessage() . " - " . $th->getLine(), [], $th->getTrace());
        }
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', 'string', 'confirmed'],
                'no_telp' => 'nullable|string|min:11|max:13',
                'birthdate' => 'nullable|date',
                'gender' => 'nullable|in:Laki-laki,Perempuan',
                'foto_profile' => 'nullable|string',
                'is_verified' => 'nullable|boolean',
                'disability_type' => 'nullable|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->api_response_validator('Periksa data yang anda isi!', [], $validator->errors()->toArray());
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = 2; // 2 adalah role untuk user
            $user->no_telp = $request->no_telp;
            $user->birthdate = $request->birthdate;
            $user->gender = $request->gender;
            $user->foto_profile = $request->foto_profile;
            $user->is_verified = true; // Menandai bahwa user belum diverifikasi
            $user->disability_type = $request->disability_type;
            $user->save();

            // Ambil data services dari request
            $services = $request->input('services', []);

            // Simpan data user_services
            foreach ($services as $serviceId) {
                $user->services()->attach($serviceId);
            }

            DB::commit();

            return $this->api_response_success('Akun berhasil didaftarkan. Silakan cek email secara berkala untuk melakukan verifikasi.');
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->api_response_error($th->getMessage() . " - " . $th->getLine(), [], $th->getTrace());
        }
    }

    public function getUserInfo()
    {
        try {
            $data = PersonalAccessToken::where('token', request()->user()->currentAccessToken()->token)->first();
            if ($data) {
                $user_info = User::where('id', $data->tokenable_id)->first();
                return $this->api_response_success('success', $user_info->toArray());
            } else {
                return $this->api_response_error('Token Tidak Ditemukan', []);
            }
        } catch (\Throwable $th) {
            return $this->api_response_error($th->getMessage() . " - " . $th->getLine(), [], $th->getTrace());
        }
    }
}
