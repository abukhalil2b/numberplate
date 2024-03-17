 <!-- new supplier -->
 <div x-data="modal">
     <button type="button" class="btn btn-success" @click="toggle">+ {{ __('new') }} </button>
     <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
         <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
             <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm mt-16">
                 <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                     {{ __('New Supplier') }}
                     <button type="button" @click="toggle" class="text-white-dark hover:text-dark">

                         <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                     </button>
                 </div>

                 <!-- form -->
                 <form method="post" action="{{ route('admin.supplier.store') }}" class="p-2">
                     @csrf

                   
                     <div class="mt-5 {{ $errors->get('name') ? 'has-error':'' }} ">
                         <label for="inputName">  Name </label>
                         <input id="inputName" name="name" type="text" placeholder="name" class="form-input" required />
                     </div>

                  
                     <button type="submit" class="btn btn-primary !mt-6"> {{__('Save')}} </button>
                     <div class="p-3">
                         @foreach($errors->all() as $error)
                         <div class="text-red-400">{{ $error }}</div>
                         @endforeach
                     </div>
                     <div class="p-3">
                         @if(session('success'))
                         <div class="text-green-600">{{ session('success') }}</div>
                         @endif
                     </div>
                 </form>
                 <!-- /form -->

             </div>
         </div>
     </div>
 </div>