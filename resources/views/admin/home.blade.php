@extends('layouts.app')

@section('title')Адмін меню@endsection

@section('content')
<div class="container main-div">
    <div class="d-flex justify-content-center">
        <a href="{{ route('adminAddAuthor') }}" class="btn btn-dark btn-lg">Форма для добавлення автора</a>
        <a href="{{ route('adminAddText') }}" class="btn btn-dark btn-lg ml-4">Форма для добавлення твору</a>
    </div>
    <hr>
    <div class="d-flex justify-content-center mt-2">
        <a href="{{ route('adminDeleteAuthor') }}" class="btn btn-danger btn-lg">Форма для вилучення автора</a>
        <a href="{{ route('adminDeleteText') }}" class="btn btn-danger btn-lg ml-4">Форма для вилучення твору</a>
    </div>
    <!-- <hr> -->
    <div class="d-flex justify-content-center">
        <a href="{{ route('adminAddTextType') }}" class="btn btn-info btn-lg mt-3">Добавлення / Вилучення типу твору</a>
    </div>
    <hr>
    <div class="d-flex justify-content-center">
        <a href="{{ route('authors') }}" class="btn btn-success btn-lg mt-3">Редагування автора</a>
        <a href="{{ route('texts') }}" class="btn btn-success btn-lg mt-3 ml-4">Редагування твору</a>
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('adminAddContact') }}" class="btn btn-info btn-lg mt-3">Добавлення контакту</a>
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('addCommentsAnswer') }}" class="btn btn-dark btn-lg mt-3">Добавлення відповіді на запитання</a>
    </div>
    
</div>
@endsection
