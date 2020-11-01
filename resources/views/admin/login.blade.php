<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$gs->title}}</title>

        <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}">  
    <style type="text/css">
.login-form {
    border: 1px solid {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
.login-icon {
    background-color: {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
.login-title {
    background-color: {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
.section-borders span {
    background-color: {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
.login-form .input-group-addon {
    color: {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
.login-btn {
    background-color: {{$gs->colors == null ? '#337AB7':$gs->colors}};
}
    </style>       
    <style>
        .field-icon {
          float: right;
          margin-left: -23px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
          padding-right:10px;
        }
        </style>   
    </head>
    <body>
        <section class="login-area" style="background-image: url('https://images.unsplash.com/photo-1482872376051-5ce74ebf0908?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1419&q=80'); height:100%; background-position: center;
        background-repeat: no-repeat;
        background-size: cover;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="login-form" style="background-color: #ffffffcc;border: 0px solid #2385aa;
                        border-radius: 30px;">
                            <div class="login-icon" style="background-image:url('https://www.merohealthcare.com/assets/images/1589046011DP-Twt.jpg');background-position: center;
                            background-repeat: no-repeat;
                            background-size: cover;">
                            </div>
                            
                            
                            <div class="section-borders">
                                <span></span>
                                <span class="black-border"></span>
                                <span></span>
                            </div>
                            
                            <div class="login-title" style="font-weight:300;text-align:center;border-radius:10px;">Business Merohealthcare <b style="color: wheat">Admin</b> Login</div>

                            @include('includes.form-error')
                            @include('includes.form-success')
                            <form action="{{ route('admin-login-submit') }}" method="POST">
                            {{ csrf_field() }}
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon" style="background: #2385aa;color:white;border-top-left-radius:10px;border-bottom-left-radius:10px;">
                                      <i class="fa fa-envelope"></i>
                                  </div>
                                 
                                  <input type="email" name="email" class="form-control" placeholder="Email" required="" style="border-top-right-radius:10px;border-bottom-right-radius:10px;">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon" style="background: #2385aa;color:white;border-top-left-radius:10px;border-bottom-left-radius:10px;">
                                        <i class="fa fa-unlock-alt"></i>
                                    </div>
                                  <input id="login_pwd" type="password" class="form-control" name="password" placeholder="Password" required="" style="border-top-right-radius:10px;border-bottom-right-radius:10px;">
                                  <i id="pass-status-create" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordCreate1()"></i>
                                </div>
                              </div>
                              <div class="form-group text-center">
                                    <button type="submit" class="btn login-btn" style="border-radius: 10px;" >LOGIN</button>
                              </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="login-footer text-center">
                                    Powered By <a href="https://incubeweb.com/" style="color: green;">Incube</a>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>

  
            </div>
        </section>


                <script>
                        function viewPasswordCreate1()
                {
                var passwordInput = document.getElementById('login_pwd');
                var passStatus = document.getElementById('pass-status-create');
                
                if (passwordInput.type == 'password'){
                    passwordInput.type='text';
                    passStatus.className='fa fa-eye-slash field-icon';
                    
                }
                else{
                    passwordInput.type='password';
                    passStatus.className='fa fa-eye field-icon';
                }
                }

                function viewPasswordCreateConfirm1()
                {
                var passwordInput = document.getElementById('confirm_password');
                var passStatus = document.getElementById('pass-status-create-confirm');
                
                if (passwordInput.type == 'password'){
                    passwordInput.type='text';
                    passStatus.className='fa fa-eye-slash field-icon';
                    
                }
                else{
                    passwordInput.type='password';
                    passStatus.className='fa fa-eye field-icon';
                }
                }

            </script>
        
        

        <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/main.js')}}"></script>
    </body>
</html>
