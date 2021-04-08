@extends('layouts.app')

@section('title')Контакти@endsection

@section('content')
<div class="container bg-light main-div">
    <div>
        <!-- <h3 class="textp_name">Плануй своє відвідування</h3> -->
        <div class="bd-callout" style="text-align: center; font-size:22px;">
        В цьому розділі ми зібрали інформацію, яка допоможе спланувати ваше відвідування бібліотеки та надасть орієнтири, що ще можна зробити разом з цим.
        </div>
        <hr>
        <h3 class="textp_name">Розклад роботи бібліотеки</h3>
        <div class="bd-callout bd-callout-info" style="text-align: justify; font-size:18px;">
        <b>пн.-пт.: 10.00–19.00</b><br> <em>субота, неділя: вихідні</em><br>
        <b>Зверніть увагу</b>: 14.00–15.00 технічна перерва в інтернет-центрі, якщо вам потрібно скористатись комп’ютером саме в цей час, зверніться на стійку реєстрації, вас зорієнтують, в якому залі вільний комп’ютер.
        </div>
        <hr>
        <div class="bd-callout bd-callout-info" style="text-align: justify; font-size:18px;">
            <h5><b>Наша адреса:</b></h5>
            м. Чернівці, вул. Головна, 1
            @isset($contacts)
            <br>
            <h5><b>Контакти</b></h5>
            <div class="card card-default" id="card_contacts">
                <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style="">
                    <ul class="list-group pull-down overflow-auto" id="contact-list" style="max-height:180px;">
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
        
        <hr>
        <h3 class="textp_name">Доступ до бібліотеки</h3>
        <div class="bd-callout bd-callout-info" style="text-align: justify; font-size:18px;">
            <ul>
                <li>Біля бібліотеки є велопарковка для трьох велосипедів.</li>
                <li>Вхід до інтернет-центру та виставкової зали обладнано пандусом</li>
                <li>Повідомте нас, якщо  візит користувача потребує додаткового супроводу, ми домовимось, як вас краще зустріти.</li>
                <li>Повідомте нас, якщо ваш візит потребує супроводу мовою жестів. Одна з наших бібліотекарок знає цю мову та зможе допомогти.</li>
            </ul>
        </div>

        <hr>
        <h3 class="textp_name">Засоби та можливості</h3>
        <div class="bd-callout bd-callout-info" style="text-align: justify; font-size:18px;">
            #wifi <br>
            <b>#комп’ютери</b><br>
            #телевізор<br>
            <b>#друк, копіювання, сканування</b><br>
            #гардероб <br>
            <b>#дитячий куточок</b><br>
            #піаніно<br>
            <b>#можливість проведення заходів</b><br>
        </div>

        <hr>
        <div style="width: 100%; height:350px; margin-bottom:30px;">
        <h3 class="textp_name">Ми на карті</h3>
        <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=%D0%A7%D0%B5%D1%80%D0%BD%D1%96%D0%B2%D1%86%D1%96+()&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            <p style="padding:20px;"></p>
    </div>
    <hr>
    <div>
        <h3 class="textp_name">Запитання та відповіді</h3>
        <div style="display:flex; justify-content:space-between;">
            <form class="form-horizontal" action="{{ route('contactsSubmit') }}" method="POST" style="width:600px; padding-bottom:20px;">
               @csrf
                <div class="form-group"> <!-- Full Name -->
                    <label for="full_name_id" class="control-label col-sm-2">Ім'я</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="full_name_id" name="user_name" placeholder="Ваше ім'я" required>
                    </div>  
                </div>

                <div class="form-group"> <!-- Email -->
                    <label for="email_id" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_id" name="user_email" placeholder="Ваш email" required>
                    </div>  
                </div>

                <div class="form-group">
                    <label for="message_id" class="control-label col-sm-2">Коментар</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="message_id" name="user_message" placeholder="Ваше повідомлення" required></textarea>
                    </div>  
                </div>	

                <div class="form-group" hidden>
                    <div class="col-sm-10">
                    <input class="" type="checkbox" id="flexSwitchCheckChecked" name="user_is_email" value="1" checked>
                    <label class="" for="flexSwitchCheckChecked">Надіслати відповідь на email</label>
                    </div>
                </div>	
                
                <div class="form-group"> <!-- Submit Button -->
                    <div class="col-sm-10 col-sm-offset-2">                     
                        <button type="submit" class="btn btn-primary">Відправити</button>
                    </div>
                </div>         
            </form> 
            <div class="overflow-auto" style="text-align:left; width:650px; height:400px; margin-bottom:30px;">
                @forelse($comments as $c)
                <div style="display:block; padding:8px 14px; background:rgba(0,0,0,0.02);">
                    <div style="display:flex; justify-content:space-between;">
                        <div style="color:gray; font-size:15px;">{{ $c->user_name }}</div>
                        <b>{{ date('d.m.Y h:m', strtotime($c->created_at)) }}</b>
                    </div>
                        <div style="color:gray; margin-left:5px; padding:0; font-size:10px;">{{ $c->user_email }}</div>
                        <div style="margin-left:15px;">{{ $c->user_message }}</div>
                </div>

                @isset($c->answer_text)
                <div class="answer" style="margin-left: 20px; margin-top:10px; display:block; padding:4px 8px; background:rgba(0,0,0,0.06);">
                    <div style="display:flex; justify-content: space-between;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                        </svg>
                        <b>{{ date('d.m.Y h:m', strtotime($c->answered_at)) }}</b>
                    </div>
                    {{ $c->answer_text }}
                </div>
                @endisset
                <div style="margin:15px;"></div>
                @empty
                <p class="text-center">Пусто, будьте першими, хто поставить запитання</p>
                @endforelse
                
            </div> 
        </div>
        <hr>
    </div>
</div>
@endsection
