<footer class="bg-gray-900 text-white mt-auto">
    <div class="px-8 lg:px-16 py-16 flex flex-col md:flex-row items-center justify-between gap-8 border-b border-gray-800">
        <!-- Branding & Address -->
        <div class="flex flex-col items-center md:items-start text-center md:text-left">
            <img src="{{ asset('assets/logo.png') }}" alt="Nibras Kalimantan" class="h-12 object-contain mb-4 brightness-0 invert opacity-90">
            <p class="text-gray-400 max-w-md leading-relaxed text-sm mb-3 text-balance">Menyediakan Koleksi Baju Muslim & Muslimah Terlengkap dan Berkualitas di Kalimantan. Melayani satuan dan partai besar.</p>
            <div class="flex items-start gap-2 text-gray-500 text-sm max-w-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <p>Alamat :<br/>Jl. Karang Anyar 1, Nomor 31, Loktabat Utara, Banjarbaru</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="w-full md:w-auto mt-6 md:mt-0 flex justify-center md:justify-end">
             <a href="{{ url('/tentang') }}" class="bg-nibras-magenta text-white px-6 sm:px-8 py-3 rounded text-sm sm:text-base font-semibold hover:bg-pink-700 transition-colors tracking-wide sm:tracking-widest flex items-center justify-center gap-2 w-full sm:w-auto max-w-xs">
                <!-- Information Icon SVG -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Hubungi Admin
            </a>
        </div>
    </div>
    
    <!-- Default Footer Bottom -->
    <div class="bg-gray-900 py-4 text-center text-xs text-gray-500">
        <p>Copyright &copy; 2026 Natachace</p>
    </div>
</footer>
