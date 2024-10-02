<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\WelcomeMail; 

class UserController extends Controller
{
    // form ekranını göster
    public function create()
    {
        return view('register'); 
    }

    // kayıt oluşturma
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'email.unique' => 'Bu e-posta adresi zaten alınmış.',
        ]);
        
        // kullanıcıyı veritabanına kaydet
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // kayıt işlemi başarılı olduktan sonra welcomemail kuyruk işlemi başlat
        if ($user) { 
            // kuyruğa kullanıcı ıd sini ekleme
           Mail::to($user->email)->queue(new WelcomeMail($user)); // id göndermek için

            // başarılı mesajı
            return redirect()->route('register')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
        } else {
            // kullanıcı gönderilmezse error mesajı ver
            return back()->withErrors('Kullanıcı kaydı başarısız oldu.');
        }
    }
}
