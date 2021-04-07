<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DataBase;
use DateTime;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $contacts = DataBase::selectContacts();

        
        return view('home', ['contacts' => $contacts]);
    }

    public function authors()
    {
        $authors = DataBase::selectAuthors();


        return view('author.index', ['authors' => $authors]);
    }

    public function author(Request $request, $id)
    {
        $author = DataBase::selectAuthor($id);
        $texts = DataBase::selectTexts($id);
        

        return view('author.detail', ['author' => $author, 'texts' => $texts]);
    }

    public function text(Request $request, $id)
    {
        $text = DataBase::selectText($id);
        $user_id = $request->user();
        if(isset($text)){
            DataBase::updateTextRating($id, $user_id);
        }
        if($user_id != NULL)
        {
            $user_id = $user_id->id;
            if(isset($text)){
                DataBase::insertUserReadText($id, $user_id, new DateTime());
            }
            $id_user_text_list = DataBase::selectIdUserTextList($user_id, $id);
        }
        else $id_user_text_list = NULL;

        $directory = 'pages/'.$id.'/';
        $pages = Storage::allFiles($directory);
        $content = null;
        $page = 1;
        if($request->input('page') == null){
            if(count($pages)>0)
                $content = Storage::get($pages[0]);
        }else{
            $page = (int)$request->input("page");
            if(count($pages) >=$page && $page>0)
                $content = Storage::get($pages[$page-1]);
        }

        return view('text.index', ['text' => $text, 'liked' => $id_user_text_list, 'pages' => $pages, 'page' => (string)$page, 'content' => $content]);
    }

    public function likeText(Request $request, $id)
    {
        $user_id = $request->user()->id;
        DataBase::insertUserTextList($id, $user_id, new DateTime());
        

        return redirect()->route('text', [$id]);
    } 

    public function dislikeText(Request $request, $id)
    {
        $user_id = $request->user()->id;
        DataBase::deleteUserTextList($id, $user_id);
        

        return redirect()->route('text', [$id]);
    } 
    

    public function texts(Request $request)
    {
        $texts = DataBase::selectAllTexts();

        return view('text.all', ['texts' => $texts]);
    } 

    public function search(Request $request)
    {
        $search_text = $request->input("search_text");
        $texts = DataBase::search($search_text);


        return view('text.all', ['texts' => $texts]);
    } 

    public function popular(Request $request)
    {
        $popular_texts = DataBase::selectPopularTexts();


        return view('text.popular', ['texts' => $popular_texts]);
    } 
}
