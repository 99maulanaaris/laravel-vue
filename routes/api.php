<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Notes')->group(function (){
    
    Route::prefix('notes')->group(function (){

        Route::post('create-new-note','NoteController@store');
        Route::get('','NoteController@index');
        Route::get('{note:slug}','NoteController@show')->name('note.show');
        Route::patch('{note:slug}/edit','NoteController@update');
        Route::delete('{note:slug}/delete','NoteController@destroy');
        
        
    });

    Route::prefix('subjects')->group(function () {

        Route::get('','SubjectController@index');
    });

});


