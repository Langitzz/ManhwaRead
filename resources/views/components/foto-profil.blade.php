@props(['user', 'size' => 40])

@if ($user->foto_profil)
    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil {{ $user->name }}"
        class="rounded-circle" style="width: {{ $size }}px; height: {{ $size }}px; object-fit: cover;">
@else
    <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold"
        style="width: {{ $size }}px; height: {{ $size }}px; background:#3b82f6; font-size: {{ $size / 2 }}px;">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif