@extends('layout.static-mobile-master')

@section('header-script')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link href="{{ asset('assets/static/mobile/css/style.css') }}" rel="stylesheet">
@endsection

@section('content')

        <main>
            <div class="auth-content">
                <div class="container">
                     @if (!Auth::check()) 
                    <div class="auth-content__head">
                        <a href="#collapseLogin" class="active">{{ __('static.mbl_form_login') }}</a><span>|</span><a href="#collapseReg">{{ __('static.mbl_form_register') }}</a>
                       <span> |</span> <a href="#collapsePassword">{{ __('static.reset_password') }}</a>
                    </div>
                     
                    <form id="collapseLogin" class="form--login" action="{{url('login')}}" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="md-form">
                                <input type="text" class="form-control" autocomplete="off" placeholder="{{__('static.email')}}" name="email" value="{{Request::old('email')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Password</label>
                            <div class="md-form">
                                <input type="password" id="pass" class="form-control" autocomplete="off" placeholder="{{__('static.password')}}" name="password" value="{{Request::old('password')}}" required>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />

                        @if(Session::get('errorLoginMsg'))
                            <div class="alert alert-danger">
                                <span> {{Session::get('errorLoginMsg')}} </span>
                            </div>
                        @endif
                         @if(Session::get('successMsg'))
                        <div class="alert alert-danger">
                            <!-- <button class="close" data-close="alert"></button> -->
                            <span> {{Session::get('successMsg')}} </span>
                        </div>
                      @endif

                        <button type="submit" class="cs-btn cs-btn--primary">Sign In</button>

                        <div class="text-right">
                            <a href="#" class="password-reset">Password Reset</a>
                        </div>

                        <div class="form-bottom">
                            <a href="javascript:void(0)">{{ __('static.mbl_account_login_help_text') }}</a>
                        </div>
                    </form>

                    <?php /* Registration */ ?>
                    <form id="collapseReg" class="form--registration" style="display: none;" action="{{url('register')}}" method="post">
                        <input type="hidden" name="register_token" value="{{Session::get('register_token')}}" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="aff" value="{{Session::get('register_aff')}}" />

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="md-form">
                                <input type="text" class="form-control" autocomplete="off" placeholder="{{__('static.email')}}" name="email" value="{{Request::old('email')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Password</label>
                            <div class="md-form">
                                <input class="form-control" autocomplete="off" placeholder="{{__('static.password')}}" name="password" value="{{Request::old('password')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">RePassword</label>
                            <div class="md-form">
                                <input class="form-control" autocomplete="off" placeholder="{{__('static.retype_password')}}" name="repassword" value="{{Request::old('repassword')}}" required>
                            </div>
                        </div>

                        @if(Session::get('errorRegMsg'))
                            <div class="alert alert-danger">
                                <span> {{Session::get('errorRegMsg')}} </span>
                            </div>
                        @endif

                        @if(sysConfig('is_register'))
                            <button type="submit" class="cs-btn cs-btn--primary">Sign Up</button>
                        @endif
                    </form>


                    <form id="collapsePassword" class="form--password" style="display: none;" action="{{url('resetPassword')}}" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="md-form">
                                <input type="text" class="form-control" autocomplete="off" placeholder="{{__('static.email')}}" name="email" value="{{Request::old('email')}}" required>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />

                        @if(Session::get('errorLoginMsg'))
                            <div class="alert alert-danger">
                                <span> {{Session::get('errorLoginMsg')}} </span>
                            </div>
                        @endif

                        <button type="submit" class="cs-btn cs-btn--primary">Get New Password</button>

                    </form>
                  @endif
                   
                    @if (Auth::check())
                   <div class="auth-content__head">
                        <a href="#collapseLogin" class="active">登錄成功</a>
                    </div>
                    <div class="m-menu__auth-info">
                    <div class="auth-email">{{Auth::user()->username}}</div>
                    <ul class="auth-list m-menu__btn-group">
                        <li><a class="cs-btn cs-btn--outline" href="{{url('usercenter')}}">Account Center</a></li>
                        <li><a class="cs-btn cs-btn--outline" href="{{url('price')}}">Buy Now</a></li>
                        <li><a class="cs-btn cs-btn--outline" href="{{url('logout')}}">Logout</a></li>
                    </ul>
                    
                    </div>
             
                    @endif
                </div>
            </div>
        </main>

@endsection

@section('footer-script')
    <!-- 3rd party JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    <script src="{{ asset('assets/static/mobile/js/app.js') }}"></script>

    <script>
        $(function() {
            $('.auth-content__head').find('a').on('click', function(e) {
                e.preventDefault();
                $('.auth-content__head').find('.active').removeClass('active');
                let id = $(this).attr('href');
                $('form').hide();
                $(id).show();
                $(this).addClass('active');
            });
            $(".password-reset").on("click", function() {
                console.log("ok");
                $('.auth-content__head').find('a').eq(2).click();
            });
            
        });
    </script>
@endsection