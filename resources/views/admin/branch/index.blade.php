<x-layout.admin>
    <div>
        <div class="flex gap-2">
            @include('inc._modal_create_branch')
            <a class="btn btn-outline-warning" href="{{ route('admin.branch.print') }}">{{ __('print') }}</a>
        </div>

        <div class="mb-5">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Username') }}</th>
                            <th>{{ __('Password') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branchs as $branch)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div class="">

                                    {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
                                    @if($branch->main_branch == 1)
                                    <div class="text-gray-400 text-[10px]">moderator</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-3 items-center text-xs">

                                    @if($branch->phone)
                                    <a target="_blank" href="https://wa.me/{{ $branch->phone }}">
                                        <x-svgicon.whatsapp />
                                    </a>
                                    @endif
                                    {{ $branch->phone }}
                                </div>
                            </td>
                            <td>
                                <div>{{ $branch->email }}</div>
                            </td>
                            <td>
                                <pre>{{ $branch->plain_password }}</pre>
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
                                            @if(auth()->user()->permission('admin.branch.edit'))
                                            <a href="{{ route('admin.branch.edit',$branch->id) }}" class="dark:hover:text-white">
                                                <x-svgicon.pen />
                                                {{ __('Edit') }}
                                            </a>
                                            @endif
                                        </li>
                                        <li>
                                            <!-- only allow superadmin -->
                                            @if(auth()->user()->id == 1)
                                            <a href="{{ route('admin.branch.permission.index',$branch->id) }}" class="dark:hover:text-white">
                                                <x-svgicon.key />
                                                {{ __('permission') }}
                                            </a>
                                            @endif
                                        </li>
                                        <li>
                                            <!-- only allow superadmin -->
                                            @if(auth()->user()->id == 1)
                                            <a href="{{ route('admin.branch.manage_permission.index',$branch->id) }}" class="dark:hover:text-white">
                                                <x-svgicon.chain />
                                                {{ __('Manage Branches') }}
                                            </a>
                                            @endif
                                        </li>
                                        <li>
                                            @if(auth()->user()->permission('admin.impersonate'))
                                            <a href="{{ route('admin.impersonate.enable',$branch->id) }}" class="dark:hover:text-white">
                                                <x-svgicon.person_behind />
                                                {{ __('login as') }}
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

            @foreach($errors->all() as $error)
            <div class="text-red-400">
                {{ $error }}
            </div>
            @endforeach

        </div>

    </div>
    </x-layout.default>