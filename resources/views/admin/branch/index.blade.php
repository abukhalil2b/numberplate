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
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th class="text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branchs as $branch)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div>
                                    {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
                                </div>
                            </td>
                            <td>
                                <div>{{ $branch->email }}</div>
                            </td>
                            <td>
                                <span class="bg-gradient-light">{{ $branch->plain_password }}
                            </td>

                            <td>
                                <div class="flex gap-4">
                                    <a href="{{ route('admin.branch.edit',$branch->id) }}" x-tooltip="Edit" class="flex items-center">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 text-warning">
                                            <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </a>

                                    <!-- only allow superadmin -->
                                    @if(auth()->user()->id == 1)
                                    <a href="{{ route('admin.branch.permission.index',$branch->id) }}" x-tooltip="Permissions" class="flex items-center">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 text-warning">
                                            <path d="M15.6807 14.5869C19.1708 14.5869 22 11.7692 22 8.29344C22 4.81767 19.1708 2 15.6807 2C12.1907 2 9.3615 4.81767 9.3615 8.29344C9.3615 9.90338 10.0963 11.0743 10.0963 11.0743L2.45441 18.6849C2.1115 19.0264 1.63143 19.9143 2.45441 20.7339L3.33616 21.6121C3.67905 21.9048 4.54119 22.3146 5.2466 21.6121L6.27531 20.5876C7.30403 21.6121 8.4797 21.0267 8.92058 20.4412C9.65538 19.4167 8.77362 18.3922 8.77362 18.3922L9.06754 18.0995C10.4783 19.5045 11.7128 18.6849 12.1537 18.0995C12.8885 17.075 12.1537 16.0505 12.1537 16.0505C11.8598 15.465 11.272 15.465 12.0067 14.7333L12.8885 13.8551C13.5939 14.4405 15.0439 14.5869 15.6807 14.5869Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                            <path d="M17.8853 8.29353C17.8853 9.50601 16.8984 10.4889 15.681 10.4889C14.4635 10.4889 13.4766 9.50601 13.4766 8.29353C13.4766 7.08105 14.4635 6.09814 15.681 6.09814C16.8984 6.09814 17.8853 7.08105 17.8853 8.29353Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </a>
                                    @endif

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