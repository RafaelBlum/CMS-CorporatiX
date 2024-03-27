<div class="flex items-center gap-x-4 text-xs">
    <time datetime="{{$getLabel()}}" class="text-gray-500">{{$getRecord()->created_at->format('M d, Y')}}</time>

    <p class="relative z-10 rounded-full {{($getRecord()->role->name == 'admin' ? 'bg-green-300':'bg-grey-300')}} px-4 font-medium text-gray-600">
        {{($getRecord()->role->name == 'admin' ? 'Administrador': 'usuário')}}
    </p>

    <div class="flex items-center">
        <input {{($getRecord()->status == true ? 'disabled checked':'disabled')}} id="disabled-radio-2" type="radio" value="" name="disabled-radio" class="w-4 h-4 text-green-900 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="disabled-radio-2" class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">{{($getRecord()->status == true ? 'Ativo':'desativado' )}}</label>
    </div>
</div>
