<?php

namespace App\Http;

use Illuminate\Support\Facades\DB;

class DataBase
{
    public static function selectAuthors()
    {
        return DB::select('SELECT * FROM authors INNER JOIN galleries ON galleries.id_author=authors.id;');
    }

    public static function selectAuthor($id)
    {
        return collect(DB::select('SELECT * FROM authors INNER JOIN galleries ON galleries.id_author=authors.id WHERE authors.id=?;', [$id]))->first();
    }

    public static function selectTexts($author_id)
    {
        return DB::select('SELECT * FROM texts WHERE id_author=?;', [$author_id]);
    }

    public static function selectText($id)
    {
        return collect(DB::select('SELECT * FROM texts WHERE id=?;', [$id]))->first();
    }

    public static function selectIdUserTextList($user_id, $text_id){
        return collect(DB::select('SELECT id FROM user_text_list WHERE id_user=? AND id_text=?', [$user_id, $text_id]))->first();
    }

    public static function selectAllTexts()
    {
        return DB::select('SELECT t.id as text_id, a.id as author_id, a.pib as author, t.name as text_name, ttype.name as type_name FROM texts AS t INNER JOIN authors AS a ON a.id=t.id_author INNER JOIN text_types as ttype ON ttype.id=t.id_type;');
    }

    public static function search($search_text)
    {
        return DB::select("SELECT t.id as text_id, a.id as author_id, a.pib as author, t.name as text_name, ttype.name as type_name FROM texts AS t INNER JOIN authors AS a ON a.id=t.id_author INNER JOIN text_types as ttype ON ttype.id=t.id_type WHERE concat(a.pib, t.name) LIKE '%".$search_text."%';");
    }

    public static function selectPopularTexts()
    {
        return DB::select("SELECT t.id as text_id, a.id as author_id, a.pib as author, t.name as text_name, ttype.name as type_name, t.rating as rating FROM texts AS t INNER JOIN authors AS a ON a.id=t.id_author INNER JOIN text_types as ttype ON ttype.id=t.id_type ORDER BY rating DESC;");
    }

    public static function selectLikedTexts($user_id)
    {
        return DB::select("SELECT t.id as text_id, a.id as author_id, a.pib as author, t.name as text_name, ttype.name as type_name, utl.create_date as create_date FROM texts AS t INNER JOIN authors AS a ON a.id=t.id_author INNER JOIN text_types as ttype ON ttype.id=t.id_type INNER JOIN user_text_list AS utl ON utl.id_text=t.id WHERE utl.id_user=? ORDER BY utl.create_date DESC;",[$user_id]);
    }


    public static function selectHistory($user_id)
    {
        return DB::select("SELECT t.name, t.id, rt.read_date FROM texts AS t INNER JOIN read_text AS rt ON rt.id_text=t.id WHERE rt.id_user=? ORDER BY rt.read_date DESC",[$user_id]);
    }

    



    public static function insertUserTextList($text_id, $user_id, $create_date){
        DB::insert('INSERT INTO user_text_list(id_user, id_text, create_date) VALUES(?,?,?)', [$user_id, $text_id, $create_date]);
    }

    public static function insertUserReadText($text_id, $user_id, $read_date){
        DB::insert('INSERT INTO read_text(id_user, id_text, read_date) VALUES(?,?,?)', [$user_id, $text_id, $read_date]);
    }



    public static function deleteUserTextList($id, $user_id){
        DB::delete('DELETE FROM user_text_list WHERE id_user=? AND id_text=?', [$user_id, $id]);
    }



    public static function updateTextRating($text_id){
        DB::update('UPDATE texts SET rating=rating+1;');
    }

}