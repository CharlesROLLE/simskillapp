<x-layouts::public :title="__('Home')">
    <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ayyamperumal S | Premium Web Gaming</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: 'Plus+Jakarta+Sans', sans-serif;
      background-color: #050505;
    }

    .fade-out {
      opacity: 0;
      transform: scale(1.02);
      transition: all 0.4s ease-in-out;
    }

    .fade-in {
      opacity: 1;
      transform: scale(1);
      transition: all 0.4s ease-in-out;
    }

    #main-display {
      transition: opacity 0.4s ease-in-out;
    }
  </style>
</head>

<body class="text-white selection:bg-purple-500">

 
  <main class="pt-24 pb-12 px-4 md:px-8 max-w-[1600px] mx-auto">
    <section id="game-portal"
      class="relative group h-[70vh] md:h-[80vh] w-full rounded-3xl overflow-hidden border border-white/5 cursor-pointer shadow-2xl">

      <div class="absolute inset-0 bg-black">
        <img id="display-img"
                     src= {{ asset("images/vr_guy_hero.png") }}
                     class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700"
                     alt="Gaming Background">
      </div>

      <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

      <div
        class="absolute bottom-0 left-0 w-full p-8 md:p-16 flex flex-col md:flex-row justify-between items-end gap-8">

        <div class="max-w-2xl space-y-4">
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-purple-600 rounded-full text-[10px] font-bold uppercase tracking-widest">Like IRL</span>
            <div class="flex text-yellow-400">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <span id="display-rating" class="ml-2 text-white text-sm font-bold">9.8 / 10</span>
            </div>
          </div>

          <h1 id="display-title" class="text-5xl md:text-7xl font-extrabold tracking-tighter leading-none">
            SIM SKILL APP
          </h1>

          <p id="display-desc" class="text-gray-300 text-lg md:text-xl max-w-xl font-medium leading-relaxed">
            Experience yourself in high-level skills Approaches. Our choices offer you the most difficult landings in the world.
            GA, Jets. 
            Turn on your VR headSet !    
         </p>

          <div class="flex gap-4 pt-4">
            <button class="px-8 py-4 bg-purple-600 hover:bg-purple-700 rounded-xl font-bold transition-transform active:scale-95">
                            Fly Now
                        </button>
            <button class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-xl font-bold transition">
                            More Info
                        </button>
          </div>
        </div>

        <div class="hidden lg:flex gap-4 items-end">
          <div
            class="w-24 h-36 rounded-xl overflow-hidden border border-white/20 rotate-[-5deg] hover:rotate-0 transition-all duration-500">
            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=300&auto=format" class="w-full h-full object-cover">
          </div>
          <div
            class="w-24 h-48 rounded-xl overflow-hidden border border-white/20 translate-y-4 hover:translate-y-0 transition-all duration-500">
            <img src="https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?q=80&w=300&auto=format" class="w-full h-full object-cover">
          </div>
        </div>

      </div>

      <div class="absolute top-8 right-8 text-right">
        <div class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40">Powered by</div>
        <div class="text-sm font-bold">Radiosabines</div>
      </div>
    </section>
  </main>

  <section class="max-w-[1600px] mx-auto px-4 md:px-8 pb-24">
    <div class="flex justify-between items-end mb-10">
      <div>
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Web app features</h2>
        <p class="text-gray-400 mt-2">Handpicked approaches by Radiosabines</p>
      </div>
      <a href="https://flightsimcoach.com/blog/best-flight-simulators/"
        class="text-purple-400 font-bold hover:text-purple-300 transition flex items-center gap-2">
          Best Flight Simulators
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

      <div
        class="group bg-[#111] rounded-2xl overflow-hidden border border-white/5 hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-2">
        <div class="aspect-video overflow-hidden">
          <img src="{{ asset('images/sim_skill_app_feature.png') }}" alt="Simulation Skill App Feature" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-5">
          <span class="text-[10px] text-purple-400 font-bold uppercase tracking-widest">Simulation</span>
          <h3 class="text-xl font-bold mt-1">FS2024 - FS2020 - X PLANE 12</h3>
          <p class="text-gray-500 text-sm mt-2 line-clamp-2">A selection of high-skill landings procedures.
            for your favorite flight simulators.
            </p>


          <button class="w-full mt-4 py-2 bg-white/5 hover:bg-purple-600 rounded-lg text-sm font-bold transition-colors">More Info</button>
        </div>
      </div>

      <div
        class="group bg-[#111] rounded-2xl overflow-hidden border border-white/5 hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-2">
        <div class="aspect-video overflow-hidden">
          <img src="{{ asset('images/blog_feature.jpg') }}" alt="Blog Feature" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-5">
          <span class="text-[10px] text-pink-500 font-bold uppercase tracking-widest">Blog</span>
          <h3 class="text-xl font-bold mt-1">Share your experience</h3>
          <p class="text-gray-500 text-sm mt-2 line-clamp-2">Tell us about your approaches, add images, video, comments.
          </p>
          <button class="w-full mt-4 py-2 bg-white/5 hover:bg-purple-600 rounded-lg text-sm font-bold transition-colors">More Info</button>
        </div>
      </div>

      <div
        class="group bg-[#111] rounded-2xl overflow-hidden border border-white/5 hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-2">
        <div class="aspect-video overflow-hidden">
          <img src="{{ asset('images/vr_feature.png') }}" alt="VR Feature" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-5">
          <span class="text-[10px] text-blue-400 font-bold uppercase tracking-widest">VR Infos</span>
          <h3 class="text-xl font-bold mt-1">Latest informations</h3>
          <p class="text-gray-500 text-sm mt-2 line-clamp-2">Explore a vast vr world,  configurations, tools, plugings, hardwares.
          </p>
          <button class="w-full mt-4 py-2 bg-white/5 hover:bg-purple-600 rounded-lg text-sm font-bold transition-colors">More Info</button>
        </div>
      </div>

      <div
        class="group bg-[#111] rounded-2xl overflow-hidden border border-white/5 hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-2">
        <div class="aspect-video overflow-hidden">
          <img src="{{ asset('images/dashboard_feature.png') }}" alt="Admin Panel Feature" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-5">
          <span class="text-[10px] text-green-400 font-bold uppercase tracking-widest">Dashboard</span>
          <h3 class="text-xl font-bold mt-1">Admin Panel</h3>
          <p class="text-gray-500 text-sm mt-2 line-clamp-2"> Manage all aspects of your Web App experience with our intuitive admin panel.
            support.</p>
          <button class="w-full mt-4 py-2 bg-white/5 hover:bg-purple-600 rounded-lg text-sm font-bold transition-colors">More Info</button>
        </div>
      </div>

    </div>
  </section>

  <script>
    const gameData = [
            {
                title: "CYBER ACTION",
                desc: "Experience high-octane web gaming with zero lag. Our custom engine brings AAA visuals directly to your browser.",
                img: "https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2000&auto=format&fit=crop",
                rating: "9.8 / 10"
            },
            {
                title: "NEON DRIFT",
                desc: "Race through the digital skylines of tomorrow. A multiplayer experience built for the modern web browser.",
                img: "https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=2000&auto=format&fit=crop",
                rating: "9.5 / 10"
            },
            {
                title: "VOID QUEST",
                desc: "Explore deep space anomalies in this stunning 3D adventure. No downloads, just pure exploration.",
                img: "https://images.unsplash.com/photo-1618193139062-2c5bf4f935b7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxnYW1lcyUyMG9ubGluZXxlbnwwfDF8fHwxNzY3NTM1ODQzfDA&ixlib=rb-4.1.0&q=80&w=1080",
                rating: "10 / 10"
            }
        ];

        let state = 0;
        const portal = document.getElementById('game-portal');
        const dImg = document.getElementById('display-img');
        const dTitle = document.getElementById('display-title');
        const dDesc = document.getElementById('display-desc');
        const dRate = document.getElementById('display-rating');

        portal.addEventListener('click', () => {
            state = (state + 1) % gameData.length;
            
            // Animation sequence
            dImg.parentElement.style.opacity = '0.3';
            dTitle.style.transform = 'translateY(20px)';
            dTitle.style.opacity = '0';

            setTimeout(() => {
                dImg.src = gameData[state].img;
                dTitle.innerText = gameData[state].title;
                dDesc.innerText = gameData[state].desc;
                dRate.innerText = gameData[state].rating;

                dImg.onload = () => {
                    dImg.parentElement.style.opacity = '1';
                    dTitle.style.transform = 'translateY(0)';
                    dTitle.style.opacity = '1';
                };
            }, 300);
        });
  </script>
</body>

</html>
</x-layouts::public>