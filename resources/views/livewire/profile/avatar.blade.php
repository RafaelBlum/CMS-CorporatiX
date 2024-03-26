<div
    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
    xmlns:x-filament="http://www.w3.org/1999/html">
{{--    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">--}}
        <form wire:submit="update({{$user->id}})" class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">

            @if($photo)
                <img wire:model="photo" src="{{ $photo->temporaryUrl()}}" alt="{{$user->name}}" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" >
            @else
                <img wire:model.live="photo" src="{{ asset('storage/'. $user->avatar)}}" alt="{{$user->name}}" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" >
             @endif

            <div>
                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Avatar perfil xxxxx</h3>
                @if($user->avatar && isset($photo))
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Imagem seleciona com sucesso! </p>
                @else
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 1024MB).</p>
                @endif
                @error('photo') <span class="error">{{ $message }}</span> @enderror


                <div class="flex items-center space-x-4">

                    <input type="file" wire:model="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
{{--    </div>--}}
</div>
