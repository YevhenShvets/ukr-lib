<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\DataBase;
use DateTime;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.login');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
          ]);
  
         if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
          {

            return redirect()->route('adminHome');
           }
          return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin');
    }

    public function adminHome(Request $request)
    {
        return view('admin.home');
    }

    public function adminAddAuthor()
    {
        return view('admin.addAuthor');
    }

    public function adminAddText()
    {
        $authors = DataBase::selectAuthors();
        $types = DataBase::selectTextTypes();


        return view('admin.addText', ['authors' => $authors, 'types' => $types]);
    }

    public function adminAddAuthorSubmit(Request $request)
    {
        $pib = $request->input("pib");
        $country = $request->input("country");
        $description_file = $request->file("description");
        $description = $description_file->openFile()->fread($description_file->getSize());
        $photo_file = $request->file("photo");
        $photo = $photo_file->openFile()->fread($photo_file->getSize());
        DataBase::insertAuthor($pib, $country, $description);
        DataBase::insertAuthorPhoto(DataBase::selectIdAuthor($pib, $country), $photo);


        return redirect()->route("adminHome");
    }

    public function adminAddTextSubmit(Request $request)
    {
        $name = $request->input("name");
        $id_author = $request->input("author");
        $id_type = $request->input("type");
        $value_file = $request->file("value");
        $value = $value_file->openFile()->fread($value_file->getSize());
        DataBase::insertText($name, $id_author, $id_type, $value);


        return redirect()->route("adminHome");
    }
}
