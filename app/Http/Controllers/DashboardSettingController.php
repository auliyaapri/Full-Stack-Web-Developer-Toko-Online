<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::where('id', $user->categories_id)->first();
        $category = Category::all();
        return view('pages.dashboard-settings', [
            'user' => $user,
            'categories' => $categories,
            'category' => $category
        ]);
    }


    public function account()
    {
        $user = Auth::user();
        $regency = Regency::where('id', $user->regencies_id)->first();
        return view('pages.dashboard-account', [
            'user' => $user,
            'regency'  => $regency
        ]);
    }
    
    


    public function destroy($id)
    {
        $user = Auth::user();

        Storage::delete('public/'.$user->image_profile);

        $user->image_profile = null;
        $user->save();

        return redirect()->route('dashboard-settings-account');

    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        if ($request->hasFile('image_profile')) {
            $data['image_profile'] = $request->file('image_profile')->store('assets/image_profile', 'public');
        }

        $item->update($data);

        return redirect()->route($redirect);
    }
}
