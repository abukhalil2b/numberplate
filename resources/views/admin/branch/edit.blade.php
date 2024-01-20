<x-layout.admin>
    <div class="p-5">
        <div class="p-4 text-center text-3xl">
        {{ $branch->email }}
        </div>
        <form method="POST" action="{{ route('admin.branch.update',$branch->id) }}">
            @csrf

            Branch Arabic Name
            <div class="relative mb-4">
                <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                        <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                </span>
                <input name="ar_branchname" type="text" placeholder="Branch Arabic Name" value="{{ $branch->ar_name }}" class="form-input ltr:pl-10 rtl:pr-10" />
            </div>

            Branch English Name
            <div class="relative mb-4">
                <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                        <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                </span>
                <input name="en_branchname" type="text" placeholder="Branch English Name" value="{{ $branch->en_name }}" class="form-input ltr:pl-10 rtl:pr-10" />
            </div>

            <x-form.radio-switch name="update_password" lable="update password"/>

            <button type="submit" class="btn btn-primary w-full">{{ __('Update') }}</button>
        </form>
    </div>
</x-layout.admin>