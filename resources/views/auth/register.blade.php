<!DOCTYPE html>
<html lang="{{ str_replace('-', '_', app()->getLocale()) }}">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <title>Đăng ký</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="logo" content="{{ site('logo') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ siteValue('favicon') }}" type="image/x-icon">
        <meta name="description" content="{{ siteValue('description') }}">
        <meta name="keywords" content="{{ siteValue('keywords') }}">
        <meta name="author" content="{{ siteValue('author') }}">
        <meta property="og:title" content="{{ siteValue('title') }}">
        <meta property="og:description" content="{{ siteValue('description') }}">
        <meta property="og:image" content="{{ siteValue('thumbnail') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ siteValue('title') }}">
        <link rel="stylesheet" href="/app/css/style.css" id="main-style-link" />
        <link rel="stylesheet" href="/app/css/style-preset.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="/app/css/auth/animate.css" rel="stylesheet" type="text/css">
        {!! site('script_head') !!}
    </head>
    <body data-pc-preset="preset-{{ siteValue('theme_admin') }}" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        {!! site('script_body') !!}
        <section class="fullscreen-banner banner banner-2 p-0 overflow-hidden bg-contain bg-pos-r animatedBackground" data-bg-img="/app/images/authentication/05.png" style="height: 771px; background-image: url(&quot;/app/images/authentication/05.png&quot;);">
            <div class="mouse-parallax" data-bg-img="/app/images/authentication/01.png" style="background-image: url(&quot;/app/images/authentication/01.png&quot;)">
                <div class="auth-main v1">
                    <div class="auth-wrapper">
                        <div class="auth-form">
                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{siteValue('logo')}}" alt="images" height="80px" />
                                        <h4 class="f-w-500 mb-1">Đăng ký</h4>
                                        <p class="mb-2">Đã có tài khoản? <a href="{{route('login')}}" class="link-primary ms-1">Đăng nhập</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('register.post') }}">
                                        @csrf
                                        @if (session('error'))
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                                <use xlink:href="#exclamation-triangle-fill"></use>
                                            </svg>
                                            <div> {{ session('error') }}</div>
                                        </div>
                                        @endif
                                        <div class="mb-2">
                                            <label class="form-label" for="name">Họ và tên</label>
                                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="username">Tên người dùng</label>
                                            <input class="form-control" type="text" id="username" name="username" value="{{ old('username') }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input class="form-control" type="password" id="password" name="password" value="{{ old('password') }}" required>
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
        <script src="/app/js/script.js"></script>
        <script src="/app/js/theme.js"></script>
        <script src="/app/js/plugins/feather.min.js"></script>
        {!! site('script_footer') !!}
        @if (session('success'))
        <script>
            Swal.fire({
                title: 'Thành công',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Đóng',
                customClass: {
                confirmButton: 'swal2-confirm btn btn-success '
                }
            })
        </script>
        @endif
        @if (session('error'))
        <script>
            Swal.fire({
                title: 'Thất bại',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'Đóng',
                customClass: {
                confirmButton: 'swal2-confirm btn btn-danger '
                }
            })
        </script>
        @endif
    </body>
</html>