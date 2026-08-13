<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'w-full py-3 rounded-xl text-white font-semibold tracking-wide transition-all duration-200',
    ]) }}
    style="
    background: linear-gradient(135deg,#2563eb,#1d4ed8);
    border:none;
    cursor:pointer;
"
    onmouseover="this.style.filter='brightness(1.08)'" onmouseout="this.style.filter='brightness(1)'">
    {{ $slot }}
</button>
