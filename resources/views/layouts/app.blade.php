<!DOCTYPE html>
<html lang="en" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'طباعة أرقام المركبات') }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">

    <div class="w-full bg-white">

        <div class="p-3 flex gap-4 justify-between">

            <div class="dropdown" x-data="dropdown" @click.outside="open = false">
                <a href="javascript:;" class="flex flex-row-reverse gap-3 items-center" @click="toggle()">
                    <div>
                        {{ app()->getLocale() == 'ar' ? Auth::user()->ar_name : Auth::user()->en_name }}
                    </div>
                    <img class="w-9 h-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="/assets/images/avatar.png" alt="avatar" />
                </a>
                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="rtl:right-0 ltr:left-0 text-dark dark:text-white-dark top-11 !py-0 w-[230px] font-semibold dark:text-white-light/90">

                    <li>
                        <a href="{{ route('profile') }}" class="h-20 dark:hover:text-white" @click="toggle">
                            <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            {{ __('Profile') }}
                        </a>
                    </li>
                    <li>
                        <a class="h-20 dark:hover:text-white" href="{{ route('localization.store','en') }}">english</a>
                    </li>
                    <li>
                        <a class="h-20 dark:hover:text-white" href="{{ route('localization.store','ar') }}">اللغة العربية</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}" class="none">
                        <li class="border-t border-white-light dark:border-white-light/10">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();" class="h-20 text-danger !py-3" @click="toggle">
                                <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0 rotate-90" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ __('Sign Out') }}
                            </a>
                        </li>
                    </form>
                </ul>
            </div>

            <a href="/branch/dashboard">
                <img src="/assets/images/logo.png" width="100" />
            </a>

        </div>

    </div>
    @if(auth()->user()->isImpersonating())
    <div class="p-1 text-orange-500 text-center bg-red-100">
        <a href="{{ route('admin.impersonate.disable') }}">
            الخروج من الحساب
        </a>
    </div>
    @endif
    @include('layouts._display_error')
    <div class="mt-3">
        {{ $slot }}
    </div>
    
    <footer class="p-5"></footer>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("dropdown", () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                }
            }));
        });
    </script>
</body>

</html>