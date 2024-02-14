<x-layout.admin>
    <div>

        <div class="flex gap-2">
            @include('inc._modal_create_user')
        </div>

        <div class="mb-5">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th class="text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div>
                                    {{ app()->getLocale() == 'ar' ? $user->ar_name : $user->en_name }}
                                </div>
                                <div>
                                    @foreach($user->roles as $role)
                                    <span class="mx-2 text-gray-400 text-xs">{{ __($role->title) }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div>{{ $user->email }}</div>
                            </td>
                            <td>
                                <span class="bg-gradient-light">{{ $user->plain_password }}
                            </td>

                            <td>
                                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                    <button type="button" class="flex items-center hover:text-primary" @click="toggle">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90 opacity-70">
                                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                        </svg>
                                    </button>
                                    <ul @click="toggle" x-show="open" x-transition="" x-transition.duration.300ms="" class="whitespace-nowrap ltr:right-0 rtl:left-0" style="display: none;">
                                        <li>
                                            <a href="{{ route('admin.user.edit',$user->id) }}" class="flex gap-1 items-center">
                                                <x-svgicon.pen />
                                                {{ __('Edit') }}
                                            </a>

                                        </li>
                                        <li>
                                            <!-- only allow superadmin -->
                                            @if(auth()->user()->id == 1)
                                            <a href="{{ route('admin.user.role_with_permissions.index',$user->id) }}" class="flex gap-1 items-center">
                                                <x-svgicon.key />
                                                {{ __('Permissions') }}
                                            </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    </x-layout.default>