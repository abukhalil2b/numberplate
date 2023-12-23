 <!-- new branch -->
 <div x-data="modal">
     <button type="button" class="btn btn-success" @click="toggle">+ {{ __('new') }} </button>
     <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
         <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
             <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                 <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                     {{ __('new branch') }}
                     <button type="button" @click="toggle" class="text-white-dark hover:text-dark">

                         <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                     </button>
                 </div>
                 <div class="p-5">
                     <form method="POST" action="{{ route('admin.branch.store') }}">
                        @csrf

                         <div class="relative mb-4">
                             <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                     <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                     <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                                 </svg>
                             </span>
                             <input name="branchname" type="text" placeholder="Branch Name" class="form-input ltr:pl-10 rtl:pr-10" />
                         </div>
                         <div class="relative mb-4">
                             <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                     <path d="M12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12C18 12.7215 17.8726 13.4133 17.6392 14.054C17.5551 14.285 17.4075 14.4861 17.2268 14.6527L17.1463 14.727C16.591 15.2392 15.7573 15.3049 15.1288 14.8858C14.6735 14.5823 14.4 14.0713 14.4 13.5241V12M14.4 12C14.4 13.3255 13.3255 14.4 12 14.4C10.6745 14.4 9.6 13.3255 9.6 12C9.6 10.6745 10.6745 9.6 12 9.6C13.3255 9.6 14.4 10.6745 14.4 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                     <path opacity="0.5" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z" stroke="currentColor" stroke-width="1.5" />
                                 </svg>
                             </span>
                             <input name="email" type="text" placeholder="Username" class="form-input ltr:pl-10 rtl:pr-10" />
                         </div>

                         <button type="submit" class="btn btn-primary w-full">{{ __('Add') }}</button>
                     </form>
                 </div>

             </div>
         </div>
     </div>
 </div>