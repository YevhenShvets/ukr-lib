@extends('layouts.app')

@section('title')Головна сторінка@endsection

@section('content')
<div class="container bg-light main-div">
    <div class="text-center text-dark">
        <h2>Сторінка ще не створена</h2>
    </div>
    @isset($contacts)
    <div class="card card-default" id="card_contacts">
        <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style="">
            <ul class="list-group pull-down" id="contact-list">
                @foreach($contacts as $contact)
                <li class="list-group-item">
                    <div class="row w-100">
                        <div class="col-6 col-sm-6 col-md-3 px-0">
                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($contact->photo)) }}" alt="" class=" mx-auto d-block img-fluid" style="height:150px;">
                        </div>
                        <div class="col-6 col-sm-6 col-md-9 text-center text-sm-left">
                            <span class="fa fa-mobile fa-2x text-success float-right pulse" title="online now"></span>
                            <label class="name lead">{{ $contact->pib }}</label><br>
                            <span class="fa fa-map-marker fa-fw text-muted" data-toggle="tooltip" title="">посада:</span>
                            <span class="text" style="color:black; font-size:17px;">{{ $contact->position }}</span>
                            <br> 
                            <span class="fa fa-map-marker fa-fw text-muted" data-toggle="tooltip" title="" >відділ:</span>
                            <span class="text-muted">{{ $contact->section }}</span>
                            <br>
                            <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip" title="">тел.:</span>
                            <span class="text-muted ">{{ $contact->phone }}</span>
                            <br>
                            <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip" data-original-title="" title="">email:</span>
                            <span class="text-muted  ">{{ $contact->email }}</span>
                        </div>
                    </div>
                    @auth('admin')
                    <div class="d-flex justify-content-center pt-2">
                        <a href="{{ route('adminEditContact', $contact->id) }}" style="color:orange;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                        <form action="{{ route('adminDeleteContactSubmit') }}" method="POST">
                            @csrf
                            <input type="text" name="contact_id" value="{{ $contact->id }}" hidden>
                            <button type="submit" class="btn" style="color:red; margin-left:20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endauth
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endisset
</div>
@endsection
