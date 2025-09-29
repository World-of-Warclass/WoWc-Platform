<aside id="menu"
    class="z-20 text-gray-200 absolute bottom-0 left-0 duration-500 p-3 w-52 h-full max-h-full text-center bg-gray-900 shadow-xl border-r border-gray-700">
    <div class="text-lg flex flex-row justify-between h-full w-full max-h-full max-w-full ">
        <ul class="flex flex-col gap-3 h-full w-full max-h-full max-w-full justify-between board-sidebar-content">
            {{ $slot }}
        </ul>
    </div>
</aside>
