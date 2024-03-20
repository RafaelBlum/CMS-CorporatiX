{{-- Conteúdo infolist page article --}}
<div class="row align-items-center">
    <div class="col-md-9">
        <div class="ms-1">
            <div class="flex items-center gap-x-4 text-xs">
                <time datetime="2020-03-16" class="text-gray-500">{{$user->created_at->format('M d, Y')}}</time>
                <p class="relative z-10 rounded-full {{($user->role->name == 'admin' ? 'bg-green-300':'bg-grey-300')}} px-4 font-medium text-gray-600">{{($user->role->name == 'admin' ? 'Administrador': 'usuário')}}</p>
            </div>

            <h1 class="text-2xl mt-3">{{$user->name}}</h1>

            <p class="text-xs text-teal-600">{{$user->academic_education}}</p>
            <p class="text-base mt-1">{{$user->email}}</p>

            <div class="row">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="mt-8">
                                <h4 class="font-semibold text-gray-900 underline dark:text-white decoration-indigo-500 ">Sobre</h4>
                                <p class="text-muted italic font-13 mb-3">
                                    {{$user->bio}}
                                </p>
                                <p class="text-muted mb-1 font-13"><strong>Estado civil </strong> <span class="ms-2">{{$user->marital_status}}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>WhatsApp </strong><span class="ms-2">{{$user->phone}}</span> / <span class="text-xs">{{$user->branch_line}}</span></p>

                                <p class="text-muted mb-1 font-13"><strong>Endereço </strong>
                                    <span class="ms-2">
                                        {{$user->address->street}}, {{$user->address->number}} - {{$user->address->bairro .  " | " . $user->address->city . "/". $user->address->state}} {{$user->address->cep}}
                                    </span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">--}}
{{--                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">--}}
{{--                    <div class="relative pl-16">--}}
{{--                        <dt class="text-base font-semibold leading-7 text-gray-900">--}}
{{--                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">--}}
{{--                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            Push to deploy--}}
{{--                        </dt>--}}
{{--                        <dd class="mt-2 text-base leading-7 text-gray-600">Morbi viverra dui mi arcu sed. Tellus semper adipiscing suspendisse semper morbi. Odio urna massa nunc massa.</dd>--}}
{{--                    </div>--}}
{{--                    <div class="relative pl-16">--}}
{{--                        <dt class="text-base font-semibold leading-7 text-gray-900">--}}
{{--                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">--}}
{{--                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            SSL certificates--}}
{{--                        </dt>--}}
{{--                        <dd class="mt-2 text-base leading-7 text-gray-600">Sit quis amet rutrum tellus ullamcorper ultricies libero dolor eget. Sem sodales gravida quam turpis enim lacus amet.</dd>--}}
{{--                    </div>--}}
{{--                    <div class="relative pl-16">--}}
{{--                        <dt class="text-base font-semibold leading-7 text-gray-900">--}}
{{--                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">--}}
{{--                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            Simple queues--}}
{{--                        </dt>--}}
{{--                        <dd class="mt-2 text-base leading-7 text-gray-600">Quisque est vel vulputate cursus. Risus proin diam nunc commodo. Lobortis auctor congue commodo diam neque.</dd>--}}
{{--                    </div>--}}
{{--                    <div class="relative pl-16">--}}
{{--                        <dt class="text-base font-semibold leading-7 text-gray-900">--}}
{{--                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">--}}
{{--                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            Advanced security--}}
{{--                        </dt>--}}
{{--                        <dd class="mt-2 text-base leading-7 text-gray-600">Arcu egestas dolor vel iaculis in ipsum mauris. Tincidunt mattis aliquet hac quis. Id hac maecenas ac donec pharetra eget.</dd>--}}
{{--                    </div>--}}
{{--                </dl>--}}
{{--            </div>--}}

         </div>
    </div>
</div>
