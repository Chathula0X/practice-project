@if(session('success') || session('error') || session('info') || session('warning'))
@php
    $type = session('success') ? 'success' :
            (session('error') ? 'error' :
            (session('warning') ? 'warning' : 'info'));

    $colors = [
        'success' => ['bg' => 'bg-green-500/90 backdrop-blur-md', 'icon' => 'text-white', 'border' => 'border-green-400'],
        'error'   => ['bg' => 'bg-red-500/90 backdrop-blur-md',   'icon' => 'text-white', 'border' => 'border-red-400'],
        'info'    => ['bg' => 'bg-blue-500/90 backdrop-blur-md',  'icon' => 'text-white', 'border' => 'border-blue-400'],
        'warning' => ['bg' => 'bg-yellow-500/90 backdrop-blur-md','icon' => 'text-white', 'border' => 'border-yellow-400'],
    ];
@endphp

<div id="toast" 
     class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-[90%] max-w-md 
            {{ $colors[$type]['bg'] }} {{ $colors[$type]['border'] }} border shadow-xl 
            rounded-xl px-6 py-4 flex items-center justify-between 
            text-white transition-all duration-700 ease-in-out opacity-100 animate-slideDown">

    <div class="flex items-center space-x-3">
        @if($type === 'success')
            <svg class="w-6 h-6 {{ $colors[$type]['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        @elseif($type === 'error')
            <svg class="w-6 h-6 {{ $colors[$type]['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        @elseif($type === 'info')
            <svg class="w-6 h-6 {{ $colors[$type]['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
        @elseif($type === 'warning')
            <svg class="w-6 h-6 {{ $colors[$type]['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86A2 2 0 0020.9 17L13.93 4a2 2 0 00-3.86 0L3.1 17a2 2 0 001.97 2z"/>
            </svg>
        @endif

        <div>
            <p class="font-semibold capitalize">{{ ucfirst($type) }}</p>
            <p class="text-sm opacity-90">
                {{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}
            </p>
        </div>
    </div>

    <button onclick="closeToast()" class="text-white/80 hover:text-white transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>

<!-- Animation -->
<style>
@keyframes slideDown {
    0% {
        opacity: 0;
        transform: translate(-50%, -40px);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}
.animate-slideDown {
    animation: slideDown 0.5s ease-out;
}
</style>

<script>
    // Auto close after 4 seconds
    setTimeout(() => closeToast(), 4000);

    function closeToast() {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translate(-50%, -40px)';
            setTimeout(() => toast.remove(), 500);
        }
    }
</script>
@endif
