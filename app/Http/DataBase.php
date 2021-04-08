<?php

namespace App\Http;

use Illuminate\Support\Facades\DB;
use DateTime;

class DataBase
{
    public static function selectAuthors()
    {
        return DB::select('SELECT * FROM authors INNER JOIN galleries ON galleries.id_author=authors.id;');
    }

    public static function selectTextTypes(){
        return DB::select("SELECT * FROM text_types");
    }

    public static function selectAuthor($id)
    {
        return collect(DB::select('SELECT * FROM authors INNER JOIN galleries ON galleries.id_author=authors.id WHERE authors.id=?;', [$id]))->first();
    }

    public static function selectTextsByType($type){
        return DB::select('SELECT t.id as text_id, a.id as author_id, a.pib as author, t.name as text_name, ttype.name as type_name FROM texts AS t INNER JOIN authors AS a ON a.id=t.id_author INNER JOIN text_types as ttype ON ttype.id=t.id_type WHERE ttype.name=?;', [$type]);
    }

    public static function selectTexts($author_id)
    {
        return DB::select('SELECT * FROM texts WHERE id_author=?;', [$author_id]);
    }

    public static function selectContacts(){
        $contacts = DB::select('SELECT * FROM contacts;');
        if(count($contacts) == 0) $contacts = null;
        return $contacts;

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
        return DB::select("SELECT t.name, t.id, rt.read_date, rt.id as rtid FROM texts AS t INNER JOIN read_text AS rt ON rt.id_text=t.id WHERE rt.id_user=? ORDER BY rt.read_date DESC",[$user_id]);
    }

    public static function selectIdAuthor($pib, $country){
        return collect(DB::select("SELECT id FROM authors WHERE PIB=? AND country=?", [$pib, $country]))->first()->id;
    }

    public static function selectContact($id){
        return collect(DB::select("SELECT * FROM contacts WHERE id=?", [$id]))->first();
    }

    public static function selectComments(){
        return DB::select("SELECT c.*, ca.answer_text, ca.created_at as answered_at FROM comments as c LEFT JOIN comments_answer as ca ON ca.id_comment=c.id order by c.id desc;");
    }

    public static function selectCommentsNoAnswer(){
        return DB::select("SELECT c.* FROM comments as c LEFT JOIN comments_answer as ca ON ca.id_comment=c.id WHERE ca.id is null;");
    }
    


    public static function insertUserTextList($text_id, $user_id, $create_date){
        DB::insert('INSERT INTO user_text_list(id_user, id_text, create_date) VALUES(?,?,?)', [$user_id, $text_id, $create_date]);
    }

    public static function insertUserReadText($text_id, $user_id, $read_date){
        DB::insert('INSERT INTO read_text(id_user, id_text, read_date) VALUES(?,?,?)', [$user_id, $text_id, $read_date]);
    }

    public static function insertAuthor($pib, $country, $description){
        DB::insert("INSERT INTO authors(PIB, country, description) VALUES(?, ?, ?)", [$pib, $country, $description]);
    }

    public static function insertAuthorPhoto($id_author, $photo){
        DB::insert("INSERT INTO galleries(id_author, photo1) VALUES(?, ?)", [$id_author, $photo]);
    }

    public static function insertText($name, $id_author, $id_type){
        DB::insert("INSERT INTO texts(name, id_author, id_type, rating) VALUES(?, ?, ?, ?)", [$name, $id_author, $id_type, 1]);
    }

    public static function insertTextTypes($name, $description){
        DB::insert("INSERT INTO text_types(name, description) VALUES(?, ?)", [$name, $description]);
    }

    public static function insertContact($pib, $position, $section, $phone, $email, $photo){
        DB::insert("INSERT INTO contacts(pib,position,section,phone,email,photo) VALUES(?,?,?,?,?,?);", [$pib, $position, $section, $phone, $email, $photo]);
    }

    public static function insertComment($user_name, $user_email, $user_message, $user_is_email){
        DB::insert("INSERT INTO comments(user_name, user_email, user_message, is_email, created_at) VALUES(?,?,?,?,?);", [$user_name, $user_email, $user_message, $user_is_email, new DateTime()]);
    }

    public static function insertCommentAnswer($id_comment, $answer_text){
        DB::insert("INSERT INTO comments_answer(id_comment, answer_text, created_at) VALUES(?,?,?);", [$id_comment, $answer_text, new DateTime()]);
    }


    public static function deleteUserTextList($id, $user_id){
        DB::delete('DELETE FROM user_text_list WHERE id_user=? AND id_text=?', [$user_id, $id]);
    }

    public static function deleteAuthor($author_id){
        DB::delete('DELETE FROM authors WHERE id=?', [$author_id]);
    }

    public static function deleteText($text_id){
        DB::delete('DELETE FROM texts WHERE id=?', [$text_id]);
    }

    public static function deleteTextType($id){
        DB::delete('DELETE FROM text_types WHERE id=?', [$id]);
    }

    public static function deleteContact($id){
        DB::delete('DELETE FROM contacts WHERE id=?', [$id]);
    }

    public static function clearHistory($user_id){
        DB::delete('DELETE FROM read_text WHERE id_user=?', [$user_id]);
    }

    public static function deleteHistory($user_id, $id){
        DB::delete('DELETE FROM read_text WHERE id_user=? AND id=?', [$user_id, $id]);
    }


    public static function updateTextRating($text_id){
        DB::update('UPDATE texts SET rating=rating+1 WHERE id=?;', [$text_id]);
    }

    public static function updateAuthor($id, $pib, $country, $description){
        if($description)
            DB::update("UPDATE authors SET PIB=?, country=?, description=? WHERE id=?;", [$pib, $country, $description, $id]);
        else
            DB::update("UPDATE authors SET PIB=?, country=? WHERE id=?;", [$pib, $country, $id]);
    }

    public static function updateAuthorPhoto($id_author, $photo){
        DB::update("UPDATE galleries SET photo1=? WHERE id_author=?", [$photo, $id_author]);
    }

    public static function updateContact($id, $pib, $position, $section, $phone, $email, $photo){
        if($photo)
            DB::update("UPDATE contacts SET pib=?,position=?,section=?,phone=?,email=?,photo=? WHERE id=?;", [$pib, $position, $section, $phone, $email, $photo, $id]);
        else
        DB::update("UPDATE contacts SET pib=?,position=?,section=?,phone=?,email=? WHERE id=?;", [$pib, $position, $section, $phone, $email, $id]);
    }

}