<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\DataBase;
use DateTime;
use Illuminate\Support\Facades\Storage;

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

    public function adminAddTextType()
    {
        $types = DataBase::selectTextTypes();


        return view('admin.addTextType', ['types' => $types]);
    }

    public function adminAddContact()
    {
        return view('admin.addContact');
    }


    public function adminEditText($id){
        $text = DataBase::selectText($id);
        $authors = DataBase::selectAuthors();
        $types = DataBase::selectTextTypes();


        $directory = 'pages/'.$id.'/';
        $pages = Storage::allFiles($directory);

        return view('admin.editText', ['text' => $text, 'authors' => $authors, 'types' => $types, 'pages' => $pages]);
    }  


    public function adminEditAuthor($id){
        $author = DataBase::selectAuthor($id);

        return view('admin.editAuthor', ['author' => $author]);
    }

    public function adminEditContact($id){
        $contact = DataBase::selectContact($id);

        return view('admin.editContact', ['contact' => $contact]);
    }

    public function adminEditContactSubmit(Request $request, $id){
        $pib = $request->input('pib');
        $position = $request->input('position');
        $section = $request->input('section');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $photo_file = $request->file("photo");
        if($photo_file)
        $photo = $photo_file->openFile()->fread($photo_file->getSize());
        else $photo = null;

        DataBase::updateContact($id, $pib, $position, $section, $phone, $email, $photo);

        return redirect()->route('adminEditContact', $id);
    }

    public function adminDeleteContactSubmit(Request $request){
        $id = $request->input('contact_id');
        DataBase::deleteContact($id);
        return redirect()->route('adminHome');
    }


    public function adminDeleteAuthor(Request $request)
    {
        $authors = DataBase::selectAuthors();

        $author_id = $request->input('author');
        

        return view('admin.deleteAuthor', ['authors' => $authors, 'author_id' => $author_id]);
    }

    
    public function adminDeleteText(Request $request)
    {
        $texts = DataBase::selectAllTexts();

        $text_id = $request->input('id');


        return view('admin.deleteText', ['texts' => $texts, 'id' => $text_id]);
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
        DataBase::insertText($name, $id_author, $id_type);


        return redirect()->route("adminHome");
    }

    public function adminAddTextTypeSubmit(Request $request){
        $name = $request->input("name");
        $description = $request->input("description");

        DataBase::insertTextTypes($name, $description);


        return redirect()->route('adminAddTextType');
    }

    public function adminAddContactSubmit(Request $request){
        $pib = $request->input('pib');
        $position = $request->input('position');
        $section = $request->input('section');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $photo_file = $request->file("photo");
        if($photo_file)
        $photo = $photo_file->openFile()->fread($photo_file->getSize());
        else $photo = null;

        DataBase::insertContact($pib, $position, $section, $phone, $email, $photo);

        return redirect()->route('adminHome'); 
    }

    public function adminEditTextAddPage(Request $request, $id){
        if ($request->hasFile('page')) {
            $number = $request->input("number");

            $page_name      = $request->file('page');
            $fileName   = $number . '.' . $page_name->getClientOriginalExtension();
            $page = $page_name->openFile()->fread($page_name->getSize());
            Storage::put('pages/'.$id.'/'.$fileName, $page, 'public');
        } 
        return redirect()->route('adminEditText', [$id]);
    }

    public function adminEditTextDeletePage(Request $request, $id){
        $file = $request->input('file_name');
        Storage::delete($file);
        return redirect()->route('adminEditText', [$id]);
    }

    public function adminEditAuthorSubmit(Request $request, $id){
        $pib = $request->input("pib");
        $country = $request->input("country");
        $description_file = $request->file("description");
        if($description_file)
        $description = $description_file->openFile()->fread($description_file->getSize());
        else $description = null;
        $photo_file = $request->file("photo");
        if($photo_file)
        $photo = $photo_file->openFile()->fread($photo_file->getSize());
        else $photo = null;

        DataBase::updateAuthor($id, $pib, $country, $description);
        if($photo)
            DataBase::updateAuthorPhoto($id, $photo);
        return redirect()->route('adminEditAuthor', $id);
    }

    public function adminDeleteAuthorSubmit(Request $request)
    {
        $id_author = $request->input("author");
        DataBase::deleteAuthor($id_author);


        return redirect()->route("adminHome");
    }

    public function adminDeleteTextSubmit(Request $request)
    {
        $id_text = $request->input("text");
        DataBase::deleteText($id_text);


        return redirect()->route("adminHome");
    }

    public function adminDeleteTextTypeSubmit(Request $request)
    {
        $id_text_type = $request->input("id");
        DataBase::deleteTextType($id_text_type);


        return redirect()->route("adminAddTextType");
    }
}
