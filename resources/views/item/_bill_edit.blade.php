<!-- new branch -->
<div x-data="bill_delete">
    <div class="flex justify-center">
        <button type="button" class="btn btn-secondary" @click="toggle"> {{ __('Edit') }} </button>
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
                    <form action="{{ route('bill.plate.update',$bill->id) }}" method="post">
                        @csrf
                        <div class="text-center w-full">
                            {{ __('code') }}

                            <input class="form-input" name="plate_code" value="{{ $bill->plate_code }}">
                        </div>
                        <div class="text-center w-full">
                            {{ __('number') }}
                            <input class="form-input" name="plate_num" value="{{ $bill->plate_num }}">
                        </div>

                        <div class="text-center w-full">
                        رصد
                            <input class="form-input" name="ref_num" value="{{ $bill->ref_num }}">
                        </div>


                        <div class="mt-3 flex gap-3">

                            <x-primary-button class="w-full justify-center" type="submit">
                                {{ __('Update') }}
                            </x-primary-button>
                            <x-secondary-button class="w-full justify-center" @click="toggle">
                                {{ __('cancel') }}
                            </x-secondary-button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('bill_delete', () => ({

            open: false,

            toggle() {
                this.open = !this.open
            }

        }));

    });
</script>