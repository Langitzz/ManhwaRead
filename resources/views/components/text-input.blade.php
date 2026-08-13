@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-700 shadow-sm transition duration-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none'
    ]) }}>
