<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Website Desa' }}</title>
  @vite('resources/css/app.css')
  
  <!-- Additional Head Content -->
  @stack('meta')
  @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Navbar -->
    <x-tenant.navbar 
        :theme="'art'" 
        :transparent="$transparentNav ?? false"
        :fixed="$fixedNav ?? true" 
    />
    
    <!-- Main Content -->
    <main class="{{ ($fixedNav ?? true) ? 'pt-16 lg:pt-20' : '' }}">
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <x-tenant.footer 
        :theme="'art'"
        :variant="$footerVariant ?? 'default'"
    />

    <!-- Scripts -->
    @stack('scripts')
    
    <script>
    // Simple animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
    </script>
</body>
</html>