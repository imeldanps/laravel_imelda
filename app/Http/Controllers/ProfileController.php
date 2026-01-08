<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = UserModel::findOrFail(Auth::id());
        $breadcrumb = (object) [ 'title' => 'Data Profil', 'list' => ['Home', 'Profil'] ];
        $page = (object) [ 'title' => 'Edit Profil Anda' ];
        $activeMenu = 'profile';
        return view('profile.index', compact('user', 'page', 'breadcrumb', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama'     => 'required|string|max:100',
            'old_password' => 'nullable|string',
            'password' => 'nullable|min:5|confirmed',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi Foto
        ]);

        $user = UserModel::findOrFail($id);

        $user->username = $request->username;
        $user->nama = $request->nama;

        // Update Password jika diisi
        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => Hash::make($request->password)]);
            } else {
                return back()->withErrors(['old_password' => 'Password lama salah']);
            }
        }

        // Upload Foto
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image && Storage::disk('public')->exists('photos/' . $user->image)) {
                Storage::disk('public')->delete('photos/' . $user->image);
            }
            
            // Simpan foto baru dengan HASH NAME agar unik
            // Kita gunakan 'storeAs' dengan parameter ke-3 yaitu 'public' (nama disk)
            $imageName = $request->file('image')->hashName();
            $request->file('image')->storeAs('photos', $imageName, 'public'); 
            
            // Simpan nama file ke database
            $user->image = $imageName;
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui');
    }
}