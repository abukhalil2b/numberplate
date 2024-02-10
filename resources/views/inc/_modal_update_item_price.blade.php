
 <!-- new branch -->
 <div x-data="item_update">
     <div class="flex justify-center">
     <button type="button" class="btn btn-sm btn-warning" @click="toggle"> {{ __('Price Update') }}  </button>
     </div>
     <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
         <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
             <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm mt-16">
                 <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                     {{ __('Update') }}
                     <button type="button" @click="toggle" class="text-white-dark hover:text-dark">

                         <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                     </button>
                 </div>
                 <div class="p-5">
                <!-- form -->
                <form method="post" action="{{ route('item.price_update',$plateItem->id) }}" class="p-2">
                     @csrf

                     <div class="mt-5 {{ $errors->get('price') ? 'has-error':'' }} ">
                         <label for="price"> {{ __('price') }}</label>
                         <input id="price" name="price" type="number" step="any" placeholder="0.000" class="form-input" value="{{ $plateItem->price }}"/>
                     </div>

                     <button type="submit" class="btn btn-primary !mt-6"> {{__('Update')}} </button>

                 </form>
                 <!-- /form -->
                 </div>

             </div>
         </div>
     </div>
 </div>

 <script>
    document.addEventListener('alpine:init',()=>{

        Alpine.data('item_update',()=>({

            open:false,

            toggle(){
                this.open = ! this.open
            }

        }));

    });
 </script>