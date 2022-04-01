<!DOCTYPE html>

<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>
            CPCE
        </title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="../../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->
        <link rel="shortcut icon" href="{{asset('assets/images/ICON.png')}}" />
    </head>
    <!-- end::Head -->
    <!-- end::Body -->
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-login m-login--signin  m-login--5" id="m_login" style="background-image: url(../../../assets/images/bg-3.jpg);">
                <div class="m-login__wrapper-1 m-portlet-full-height">
                    <div class="m-login__wrapper-1-1">
                        <div class="m-login__contanier">
                            <div class="m-login__content">
                                <div class="m-login__logo">
                                    <a href="#">
                                        <img alt="" src="{{asset('assets/images/logo_blanco.jpg')}}"/>
                                    </a>
                                </div>
                                <div class="m-login__title">
                                    <h3>
                                        CONSEJO PROFESIONAL DE CIENCIAS ECONOMICAS CORRIENTES
                                    </h3>
                                </div>
                                <div class="m-login__desc">
                                <span class="m-footer__copyright">
                                    {{date('Y')}} &copy; 
                                    <a href="#" class="m-link">
                                        cpce
                                    </a>
                                </span>
                                </div>
                                <div class="m-login__form-action">
                                </div>
                            </div>
                        </div>
                        <div class="m-login__border">
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="m-login__wrapper-2 m-portlet-full-height">
                    <div class="m-login__contanier">
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Ingresar
                                </h3>
                            </div>

                            <form class="m-login__form m-form" method="POST" action="{{ route('iniciarSesion') }}">
                            {{ csrf_field() }}
                              
                                @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                {{$errors->first()}}
                                </div>
                                @endif

                                <div class="form-group m-form__group">                                  
                                    <input id="username" type="text" class="form-control m-input" placeholder="Nombre de usuario" name="username" value="{{ old('username') }}" required autofocus>
                                    @if ($errors->has('username'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('username') }}</strong>
                                      </span>
                                    @endif

                                </div>
                                <div class="form-group m-form__group">
                                    <input id="password" type="password" class="form-control m-input m-login__form-input--last" placeholder="Contraseña" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                                <div class="row m-login__form-sub">
                                    <div class="col m--align-left">
                                        <label class="m-checkbox m-checkbox--focus">
                                            <input type="checkbox" name="remember">
                                            Recordar
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Ingresar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <!--begin::Base Scripts -->
        <script src="../../../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="../../../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->   
        <!--begin::Page Snippets -->
        <script src="../../../assets/snippets/pages/user/login.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
