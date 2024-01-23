@props(['lable'])
<div class="flex gap-1">
<label class="relative h-6 w-12" >
    <input {{ $attributes }} type="checkbox" class="custom_switch peer absolute z-10 h-full w-full cursor-pointer opacity-0" id="custom_switch_checkbox2">
    <span for="custom_switch_checkbox2" class="outline_checkbox bg-icon block h-full rounded-full border-2 border-[#ebedf2] before:absolute before:left-1 before:bottom-1 before:h-4 before:w-4 before:rounded-full before:bg-[#ebedf2] before:bg-[url('/assets/images/close.svg')] before:bg-center before:bg-no-repeat before:transition-all before:duration-300 peer-checked:border-primary peer-checked:before:left-7 peer-checked:before:bg-primary peer-checked:before:bg-[url('/assets/images/checked.svg')] dark:border-white-dark dark:before:bg-white-dark"></span>
</label>
{{ $lable }}
</div>