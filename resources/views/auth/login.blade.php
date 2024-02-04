<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- email  -->
        <div>
            <x-input-label for="email" :value=" 'المستخدم' " />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative" x-data="login">
            <div class="absolute left-3 top-10 cursor-pointer text-xs" @click="toggleInput">
                <span x-show="show">
                    <x-svgicon.open_eye />
                </span>
                <span x-show=" ! show">
                    <x-svgicon.close_eye />
                </span>
            </div>
            <x-input-label for="password" :value=" 'كلمة المرور' " />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="mr-2 text-sm text-gray-600">
                    تذكرني
                </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="mr-3">
                تسجيل الدخول
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.data('login', () => ({

                show: false,

                toggleInput() {
                    this.show = !this.show

                    var input = document.getElementById('password');

                    if (input.type == 'text') {
                        input.type = 'password'
                    } else if (input.type == 'password') {
                        input.type = 'text'
                    }
                }

            }));

        });
    </script>


</x-guest-layout>