<x-layouts.auth>
    <div class="login-card login-dark">
        <div>
            <div>
                <a class="logo text-start" href="/">
                    <img class="img-fluid for-dark" src="{{ asset('tenant/images/logo/logo.png') }}" alt="logo">
                    <img class="img-fluid for-light" src="{{ asset('tenant/images/logo/logo_dark.png') }}" alt="logo">
                </a>
            </div>
            <div class="login-main"> 
                <form class="theme-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                    
                    <h4>Sign in to account</h4>
                    <p>Enter your email & password to login</p>
                    
                    <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" id="email" type="email" name="email" required="" placeholder="your@email.com" value="{{ old('email') }}" autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <div class="form-input position-relative">
                        <input class="form-control" id="password" type="password" name="password" required="" placeholder="*********" autocomplete="current-password">
                        <div class="show-hide"><span class="show"></span></div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                    </div>
                    
                    <div class="form-group mb-0">
                        <div class="checkbox p-0">
                        <input id="remember_me" name="remember" type="checkbox">
                        <label class="text-muted" for="remember_me">Remember password</label>
                        </div>
                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <div class="mt-3 text-end">
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                    
                    @if (tenancy()->initialized)
                        <h6 class="text-muted mt-4 text-center">
                            Kamu masuk kedalam tenant {{ tenant('name') ?? 'your tenant account' }}
                        </h6>
                    @else
                        <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                        <div class="social mt-4">
                            <div class="btn-showcase">
                                <a class="btn btn-light" href="#"><i class="fa fa-linkedin"></i> LinkedIn </a>
                                <a class="btn btn-light" href="#"><i class="fa fa-twitter"></i> Twitter</a>
                                <a class="btn btn-light" href="#"><i class="fa fa-facebook"></i> Facebook</a>
                            </div>
                        </div>
                        <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>