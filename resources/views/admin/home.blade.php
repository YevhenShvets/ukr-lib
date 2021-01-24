@extends('layouts.app')

@section('title')Адмін меню@endsection

@section('content')
<div class="container main-div">
    <div class="d-flex justify-content-center">
        <a href="{{ route('adminAddAuthor') }}" class="btn btn-dark btn-lg">Форма для добавлення автора</a>
        <a href="{{ route('adminAddText') }}" class="btn btn-dark btn-lg ml-4">Форма для добавлення твору</a>
    </div>
</div>
@endsection
