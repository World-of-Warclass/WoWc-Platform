<x-guest-layout>
    <div class="max-h-screen overflow-hidden relative w-full">

        <x-welcome-header />

        <section class="w-full">
            <div class="absolute bottom-0 w-full z-10">
                <div class="flex flex-row-reverse w-full p-0 xl:pr-16 justify-center xl:justify-normal">
                    <div
                        class="flex flex-col p-8 rounded-t-3xl bg-accent gap-4 bg-opacity-95 text-white text-center xl:text-left">
                        <h1 class="text-7xl font-extrabold">World of Warclass</h1>
                        <p class="text-3xl font-medium">Transformando tareas en verdadero aprendizaje</p>
                    </div>
                </div>
            </div>
            <img src="{{ asset('/img/img1.png') }}" class="min-h-96 w-screen h-full brightness-[85%] -z-10"
                alt="Teacher and student smiling at each other in the classroom" loading="auto">
        </section>

    </div>

    <section class="bg-base-100 p-32 mx-auto flex flex-col gap-16 w-full max-w-[100vw] h-full">
        <article
            class="flex flex-col-reverse lg:flex-row gap-x-0 gap-y-8 lg:gap-x-16 lg:gap-y-0  items-center w-full h-full text-2xl text-center lg:text-left text-pretty ">
            <div class="flex-1 flex flex-col gap-8 lg:w-1/2 h-full z-20">
                <section class="flex flex-col gap-4">
                    <h2 class="text-5xl font-bold">¿Qué es "World of Warclass"?</h2>
                    <p>Plataforma educativa innovadora que motiva a los estudiantes mediante misiones temáticas y
                        recompensas, competiendo ente ellos.</p>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="text-5xl font-bold">Nuestros Objetivos</h2>
                    <ul>
                        <li class="lg:list-disc">Conectar con los alumnos a través de juegos recreativos para incentivar
                            el
                            aprendizaje.
                        </li>
                        <li class="lg:list-disc">Facilitar la administración del proceso educativo y maximizar la
                            eficiencia.</li>
                    </ul>
                </section>
            </div>
            <div class="flex justify-center flex-1 w-1/2 h-auto aspect-square z-10">
                <canvas id="canvas"></canvas>
            </div>
        </article>
    </section>

    <section class="flex flex-col gap-4 bg-accent p-32 mx-auto w-full text-3xl text-center">
        <h1 class="text-5xl font-bold">Nuestra misión</h1>
        <p class="">Mejorar la experiencia educativa mediante la integración de elementos de gamificación,
            aventuras de
            aprendizaje personalizadas y aprendizaje socioemocional en el entorno del aula, lo que en última instancia
            conduce a estudiantes más felices y comprometidos.</p>
    </section>

    <section class="flex flex-col gap-24 items-center bg-base-100 w-full p-32 mx-auto text-3xl text-center">
        <div class="flex flex-col gap-4">
            <h1 class="text-5xl font-bold text-center">Tenemos esto para ti</h1>
            <p class="text-center">Sé parte de la nuestra comunidad y accede a todos los servicios
                digitales que te
                ofrecemos en nuestra plataforma online.</p>
        </div>

        <article id="image-carousel" class="splide card w-[40rem] bg-accent shadow-xl">
            <div class="splide__track card-body">
                <ul class="splide__list">
                    <li class="splide__slide px-32 flex flex-col gap-4">
                        <p class="">
                            Conectamos a los alumnos a través de principios recreativos para incentivar el aprendizaje y
                            lograr desarrollar su habilidad cognitiva.
                        </p>
                    </li>


                    <li class="splide__slide px-32 flex flex-col gap-4">
                        <div>
                            Los estudiantes acceden a una metodología de aprendizaje competitivo junto al sistema de
                            apoyo de múltiples niveles.
                        </div>
                    </li>
                </ul>
            </div>
        </article>

    </section>

    <footer class="footer p-8 text-base-content mt-auto" data-theme="wowc_neutral">
        <nav>
            <h6 class="footer-title">Team</h6>
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
        </nav>
        <nav>
            <h6 class="footer-title">Useful Links</h6>
            <a class="link link-hover" href="https://github.com/World-of-Warclass" target="_blank">Github</a>
            <a class="link link-hover">Special Thanks</a>

        </nav>
        <nav>
            <h6 class="footer-title">Social</h6>
            <div class="grid grid-flow-col gap-6 place-items-center text-2xl">
                <a href="https://github.com/World-of-Warclass" target="_blank"
                    class="transition-transform transform-growth hover:scale-110 duration-200"><span
                        class="icon-[ri--github-fill]"></span></a>
                <a href="#" class="transition-transform transform-growth hover:scale-110 duration-200"><span
                        class="icon-[ri--facebook-circle-fill]"></span></a>
                <a href="#" class="transition-transform transform-growth hover:scale-110 duration-200"><span
                        class="icon-[ri--twitter-x-line]"></span></a>
                <a href="#" class="transition-transform transform-growth hover:scale-110 duration-200"><span
                        class="icon-[ri--youtube-fill]"></span></a>
                <a href="#" class="transition-transform transform-growth hover:scale-110 duration-200"><span
                        class="icon-[ri--soundcloud-line]"></span></a>
            </div>
        </nav>
    </footer>

    @push('scripts')
        @vite('resources/js/welcome.js')
    @endpush
</x-guest-layout>
