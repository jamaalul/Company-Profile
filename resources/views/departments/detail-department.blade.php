<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HIMTI 2025 - {{ $department->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        script: ['Dancing Script', 'cursive'],
                    },
                    colors: {
                        himti: {
                            primary: "#133D87",
                            secondary: "#608BC0", 
                            light: "#DDF0FF",
                            dark: "#0F2B5D",
                            cream: "#F4F3DF",
                            line: "#CBDDEB",
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .font-script { font-family: 'Dancing Script', cursive; }
    </style>
</head>
<body class="bg-white font-sans">
    <div class="min-h-screen bg-white">
        <div class="fixed top-4 left-4 right-4 z-50">
            @include('components.navbar')
        </div>

        <main class="mb-24">
            @if($department->detail)
            <section class="relative min-h-screen flex items-center pt-32 pb-16 overflow-hidden">
                <div class="absolute top-0 right-0 h-full w-full lg:w-1/2 flex items-start justify-end z-0">
                    <img src="https://api.builder.io/api/v1/image/assets/TEMP/476474d2968bf63b1f1c2aa5d304fcec95812a73?width=1844" alt="" class="h-auto w-full max-w-xl md:max-w-2xl lg:max-w-3xl object-contain opacity-10 lg:opacity-20 -mr-32 lg:-mr-32">
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
                    <div class="flex">
                        <div class="w-full lg:w-2/3 text-center lg:text-left">
                            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-himti-primary leading-tight mb-4">
                                {!! strtoupper($department->name) !!}
                            </h1>
                            <div class="bg-himti-secondary px-6 py-4 inline-block mb-6">
                                <h2 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold">
                                    HIMTI 2025
                                </h2>
                            </div>
                            <p class="text-himti-primary text-2xl md:text-3xl lg:text-4xl font-normal italic font-script">
                                {{ $department->detail->division_words }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col lg:flex-row items-center gap-12">
                        <div class="flex-1 flex justify-center order-1 lg:order-none">
                            <div class="relative w-full max-w-lg">
                                <div class="aspect-[4/5] bg-gray-200 rounded-xl overflow-hidden">
                                    <img src="{{ asset($department->detail->head_photo) }}" alt="Ketua Departemen {{ $department->name }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 space-y-4 text-center lg:text-left">
                            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-himti-primary">
                                Ketua Departemen
                            </h2>
                            <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-himti-secondary">
                                {{ $department->detail->head_name }}
                            </h3>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            {{-- Loop untuk Sub Departemen & Program Kerja --}}
            @foreach ($department->subDepartments as $subDept)
                <section class="py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-himti-primary mb-8 text-center lg:text-left">
                            {{ $subDept->name }}
                        </h2>
                        <div class="w-full h-1.5 bg-himti-line mb-12"></div>
                        <div class="flex justify-center">
                            <div class="w-full max-w-2xl">
                                <div class="aspect-[4/5] bg-gray-200 rounded-xl overflow-hidden">
                                    <img src="{{ asset($subDept->sub_department_photo) }}" alt="{{ $subDept->name }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @if ($subDept->work_programs && count($subDept->work_programs) > 0)
                <section class="relative py-16">
                    <div class="absolute inset-0 overflow-hidden">
                        <svg class="w-full h-full object-cover" viewBox="0 0 1920 745" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                            <path d="M0 0C0 0 580.562 43.7348 953.051 43.7348C1325.54 43.7348 1920 0 1920 0V745C1920 745 1325.42 640.187 953.051 640.187C580.686 640.187 0 745 0 745V0Z" fill="url(#paint{{$loop->index}}_linear)"/>
                            <defs>
                                <linearGradient id="paint{{$loop->index}}_linear" x1="-713.299" y1="393.613" x2="3019.48" y2="393.613" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#133D87"/><stop offset="0.38" stop-color="#608BC0"/><stop offset="0.52" stop-color="#608BC0"/><stop offset="1" stop-color="#133D87"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>

                    <div class="relative z-10 w-full mx-auto px-4">
                        <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white text-center mb-16" style="margin-top:20px;">
                            PROGRAM KERJA
                        </h2>
                        
                        <div id="scroll-container-{{ $loop->index }}" class="relative w-full overflow-x-auto py-12 scrollbar-hide mb-5 flex justify-center" style="scroll-behavior: smooth;">
                            <div class="flex items-end px-8 min-w-max mb-16" style="padding-bottom: 20px;">
                                
                                @foreach ($subDept->work_programs as $key => $proker)
                                    @php
                                        $total_cards = count($subDept->work_programs);
                                        $center_index = floor($total_cards / 2);
                                        $is_center_card = ($key == $center_index);

                                        $distance_from_center = abs($key - $center_index);
                                        $y_translate = $distance_from_center * 25;
                                        $z_index = $total_cards - $distance_from_center;
                                        $margin_left = ($key == 0) ? '0px' : '-60px';
                                        $styleString = "width: 450px; height: 180px; transform: translateY({$y_translate}px); z-index: {$z_index}; margin-left: {$margin_left}; box-shadow: rgba(0, 0, 0, 0.15) 0px 14px 45px;";
                                    @endphp

                                    <div class="bg-himti-light rounded-xl p-6 transition-all duration-300 flex flex-col justify-center hover:shadow-2xl hover:-translate-y-4 relative border border-white/50 @if($is_center_card) is-center-card @endif" 
                                         style="{{ $styleString }}">
                                        <h3 class="text-himti-primary text-xl font-bold text-center mb-3">{{ $proker['title'] }}</h3>
                                        <p class="text-black text-center text-base leading-relaxed">{{ $proker['description'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            @endforeach
        </main>

        @include('components.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollContainers = document.querySelectorAll('[id^="scroll-container-"]');
            
            scrollContainers.forEach(container => {
                const centerCard = container.querySelector('.is-center-card');

                if (container && centerCard) {
                    // Hitung posisi scroll agar bagian tengah kartu berada di tengah kontainer
                    const containerWidth = container.clientWidth;
                    const cardWidth = centerCard.clientWidth;
                    const cardLeft = centerCard.offsetLeft;

                    const scrollTo = cardLeft - (containerWidth / 2) + (cardWidth / 2);

                    container.scrollLeft = scrollTo;
                }
            });
        });
    </script>
</body>
</html>