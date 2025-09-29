@props(['teacher', 'institution_courses', 'inscriptions', 'teachers_courses'])

<div class="flex justify-center flex-col w-full gap-3 bg-gray-800 shadow-lg my-20 mx-10 p-6 rounded-lg border border-gray-700 text-gray-100">

    <section class=" py-1 flex justify-end items-center gap-3">
        
        <a href="{{ route('help.invitations') }}" 
           class="text-yellow-400 hover:text-yellow-300 text-sm underline"
           title="¿Necesitas ayuda? Haz clic aquí">
            ❓ ¿Cómo unirse?
        </a>

        <button
            class="flex bg-yellow-500 py-2 px-4 gap-3 border-[3px] rounded-3xl items-center text-xl hover:border-yellow-600 hover:bg-yellow-400 text-white transition-all duration-200 shadow-lg"
            onclick="my_modal_1.showModal()"
            title="Haz clic aquí para introducir el código de invitación que te proporcionó tu profesor">
            <span class="icon-[fluent-mdl2--circle-addition-solid]"></span>
            <p class="font-bold">Unirse a una clase</p>
            <span class="text-sm bg-white text-yellow-600 px-2 py-1 rounded-full ml-2">Código aquí</span>
        </button>

        <dialog id="my_modal_1" class="modal">
            <div class="modal-box p-8 text-black bg-white border">
                <h3 class="font-bold text-2xl justify-center flex w-full">Introduce el código de Invitación</h3>
                <div class="modal-action">
                    <form method="post" action="{{ route('validation.inscription') }}" class="flex flex-col w-full justify-center items-center gap-4">
                        @csrf
                        <!-- Mostrar errores de validación -->
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-full">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flex flex-col w-full gap-4">
                            <label for="code-union" class="text-lg font-semibold">Código de invitación: </label>
                            <input type="text" 
                                   id="code-union" 
                                   name="code"
                                   value="{{ old('code') }}"
                                   class="text-neutral-700 rounded-lg px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 w-full"
                                   placeholder="Introduce el código de invitación"
                                   required>
                        </div>

                        <!-- El código de invitación contiene toda la información necesaria -->

                        <div class="flex gap-2 w-full">
                            <button type="submit"
                                class="btn flex-1 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold">
                                Unirse al Curso
                            </button>
                            <button type="button" 
                                onclick="my_modal_1.close()"
                                class="btn flex-1 bg-gray-300 hover:bg-gray-400 text-black">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    </section>

    <section class="text-gray-100 flex gap-3 flex-col flex-wrap">
        <div tabindex="0" class="collapse collapse-arrow border border-gray-600 bg-gray-700 duration-300 rounded-lg shadow-sm">
            <input type="checkbox" class="w-full" />
            <div class="collapse-title text-xl font-bold text-gray-100">Mis Cursos</div>
            <div class="collapse-content flex flex-wrap flex-col gap-3 pt-2">

    @foreach ($inscriptions as $item)
        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
            <p class="text-gray-100 font-semibold text-lg mb-3">{{ $item->course->name }}</p>
            <form action="{{ route('player', ['token' => $item->course->token]) }}" method="get">
                <input type="hidden" name="token" value="{{ $item->course->token }}">
                <button class="btn w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors" type="submit">Unirse al Curso</button>
            </form>
        </div>
    @endforeach
            </div>
        </div>
    </section>

    @if (count($teacher) > 0)
        <section class="text-gray-900 flex gap-3 flex-col flex-wrap">
            <div tabindex="0" class="collapse collapse-arrow border border-gray-300 bg-gray-100 duration-300 rounded-lg shadow-sm">
                <input type="checkbox" class="w-full" />
                <div class="collapse-title text-xl font-bold text-gray-800">Profesor</div>
                <div class="collapse-content flex flex-wrap flex-col gap-3 pt-2">

                    @foreach ($teacher as $teachers)
                        <div tabindex="0" class="collapse collapse-arrow duration-500 border border-gray-600 bg-gray-800 shadow-sm rounded-lg">
                            <input type="checkbox" class="w-full" />
                            <div class="collapse-title text-xl font-semibold text-gray-100">
                                <h2>{{ $teachers->institution->name }}</h2>
                            </div>

                            <div class="collapse-content flex gap-4 flex-col flex-wrap pt-2">
                                <form class="w-full" method="GET"
                                    action="{{ route('master.create-courses', ['id' => $teachers->institution->id]) }}">
                                    @csrf
                                    <button class="btn bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">Crear Clase</button>
                                </form>

                                @foreach ($institution_courses as $institution_course)
                                    @if ($institution_course->teacher->institution->id == $teachers->institution->id)
                                        <div class=" rounded-lg">


                                            <div class="bg-red-600 p-4 flex justify-between rounded-t-lg items-center">

                                                <p class="text-xl font-semibold text-white">
                                                    {{ $institution_course->course->name }}
                                                </p>


                                                <div class=" flex justify-between gap-3 items-center text-white">
                                                    <div class="dropdown dropdown-bottom dropdown-end flex">
                                                        <span
                                                            class=" icon-[material-symbols--colors] text-4xl hover:bg-red-300"
                                                            tabindex="0" role="button"
                                                            onclick="my_modal_1.showModal()"></span>
                                                    </div>

                                                    <form method="GET"
                                                        action="{{ route('invitation.course', ['token' => $institution_course->course->token]) }}"
                                                        class="cursor-pointer rounded-3xl border-[3px] py-1 px-2 hover:border-yellow-400 hover:bg-red-700">
                                                        <button type="submit"
                                                            class="mx-3 font-semibold text-xl">Invitar
                                                            alumno</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div
                                                class="p-4 h-32 bg-gray-700 flex justify-center items-center rounded-b-lg border-t border-gray-600">
                                                <p class="text-lg text-gray-200 text-center">
                                                    {{ $institution_course->course->description ?: 'Sin descripción disponible' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>

    @endif

</div>

</div>
