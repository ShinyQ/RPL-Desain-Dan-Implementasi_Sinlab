<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_login(){
        if (session()->get('user')){
            return redirect()->back();
        }

        return view('login');
    }

    public function index(){
        $title = "Daftar Pengguna";
        $users = User::latest()->paginate();

        return view('user.index', compact('users', 'title'));
    }
    public function profile(){
        $title = "Profile";
        $user = User::findOrFail(request()->session()->get('user')->id);

        return view('user.profile', compact('user', 'title'));
    }

    public function update_role($id, $role){
        $user = User::where('id', $id)->update(['role'=> $role]);

        if($user){
            session()->flash('success', 'Sukses Mengupdate Role User');
        } else {
            session()->flash('failed', 'Gagal Mengupdate Role User');
        }

        Return redirect()->back();
    }

    public function update(Request $request){
        try {
            $image = base64_encode(file_get_contents($request->file('ktm')));
            $image = str_replace(array("\r", "\n"), '', $image);

            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://api.ocr.space/parse/image', [
                    'headers' => [
                        'apiKey' => '9fe7c835a888957',
                    ],
                    'form_params' => [
                        'base64Image' => 'data:image/jpeg;base64,'.$image,
                        'language' => 'eng'
                    ],
                ],
            );

            $text = response()->json(json_decode(($response->getBody()->getContents())))->getContent();
            $text = json_decode($text, true);
            $text = $text['ParsedResults'][0]['ParsedText'];
            $text = preg_match_all('/\d{10}/m', $text, $matches, PREG_SET_ORDER, 0);

            if($text){
                $id = Auth::user()->id;
                $name = $request->file('ktm')->getClientOriginalName();

                $request->ktm->move(public_path('assets/images/user/'. $id), $name);

                User::where('id', $id)->update([
                    'is_verified' => 1,
                    'ktm' => $name,
                    'phone' => $request->phone
                ]);

                return redirect()->back()->with('success', 'KTM Sukses Diverifikasi');
            }

            return redirect()->back()->with('error', 'KTM Gagal Diverifikasi');
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function logout(){
        request()->session()->forget('user');
        return redirect('user/login')->with('success', 'Sukses Melakukan Logout');
    }
}
