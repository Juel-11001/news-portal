<?php

use App\Models\Language;

/** formate tags */


/** formate the tags list */
function formateTags(array $tags)
{
    $data=implode(',', $tags);
    return $data;
}

/** get select language form session */
function getLanguage(){
    if(session()->has('language')){
        return session('language');
    }else{
        try{
            $language=Language::where('default', 1)->first();
            // session(['language', $language->lang]);
            setLanguage($language->lang);
            return $language->lang;
        }catch(\Throwable $th){
            // session(['language' => 'en']);
            setLanguage('en');
            return $language->lang;
        }
    }
}
/** set session language */
function setLanguage($code){
    session(['language' => $code]);
}

/** limit text */
function limitText(string $text, int $limit=100): String 
{
    return \Str::limit($text, $limit, '...');
}