@if(Route::current()->getName() === 'filament.admin.auth.login')
    <img src="{{asset('image/readme/corporatix-brand-v-white-720.png')}}"
         alt="{{config('app.name')}}"
         title="{{config('app.name')}}"
         width="200"
         class="mb-2 p-3"
    >
@else
    <img src="{{asset('image/readme/corporatix-brand-h-white-480.png')}}"
         alt="{{config('app.name')}}"
         title="{{config('app.name')}}"
         width="165"
    >
@endif
