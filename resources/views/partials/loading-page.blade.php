{{--
    JobFinder loading screen partial.
    Include this right after the opening <body> tag in your main layout, e.g.:

        <body>
            @include('partials.loading-screen')
            ...rest of your layout...
        </body>
--}}
<div id="app-loading-screen" class="loading-screen" role="status" aria-live="polite" aria-label="Loading">
    <video
        id="loading-video"
        class="loading-screen__video"
        src="{{ asset('videos/jobfinder-loading.mp4') }}"
        autoplay
        muted
        playsinline
        preload="auto"
    ></video>
    <button id="skip-video-splash" class="skip-btn" style="position: absolute; top: 2rem; right: 2rem; z-index: 100; background: rgba(255,255,255,0.5); border: none; padding: 0.5rem 1rem; border-radius: 20px; color: #1B2033; font-weight: 600; cursor: pointer; backdrop-filter: blur(5px);">Skip</button>
</div>

<style>
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: #EDEEF0; /* Match the video background */
        z-index: 999999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 1s ease-out, visibility 1s ease-out;
    }
    
    .loading-screen.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    
    .loading-screen__video {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure video covers screen without stretching */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const splash = document.getElementById('app-loading-screen');
        const skipBtn = document.getElementById('skip-video-splash');
        const video = document.getElementById('loading-video');
        
        const hideSplash = () => {
            splash.classList.add('is-hidden');
            sessionStorage.setItem('videoSplashShown', 'true');
            if (video) video.pause();
        };
        
        // Only show once per session
        if (!sessionStorage.getItem('videoSplashShown')) {
            // Listen for video end to automatically hide
            if (video) {
                video.addEventListener('ended', hideSplash);
                // Fallback timeout just in case video fails to play or loads forever
                setTimeout(hideSplash, 9000);
            } else {
                setTimeout(hideSplash, 8000);
            }
            
            skipBtn.addEventListener('click', hideSplash);
        } else {
            splash.style.display = 'none';
        }
    });
</script>
