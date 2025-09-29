<li tabindex="0" id="{{ $id }}"
    class="text-gray-200 collapse collapse-arrow cursor-default rounded-md transition-all duration-500 hover:bg-white hover:bg-opacity-10">
    <input type="checkbox" class="w-full h-full rounded-md" />
    <div class="collapse-title">
        <div class="flex flex-row gap-2 items-center">
            <div class="text-xl grid place-items-center">
                <span class="{{ $icon ?? '' }}"></span>
            </div>
            <span class="font-medium">
                {{ $name }}
            </span>
        </div>
    </div>
    <ul class="text-gray-200 text-left collapse-content flex flex-col gap-2 mt-2">
        {{ $items }}
    </ul>
</li>
