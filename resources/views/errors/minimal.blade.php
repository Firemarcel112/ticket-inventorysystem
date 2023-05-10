@include("head", ["title" => "Fehler"])

<main>
    @include("component.header")
    @include("component.sidebar")

    <div class="app">
        <div class="mt-48">
            <svg class="mx-auto mb-4 dark:stroke-white stroke-black dark:fill-white fill-black 2xl:w-80 xl:w-80 lg:w-72 md:w-60 w-32" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 344.74"><path d="M57.18 0h384.51c6.08 0 11.05 4.96 11.05 11.05v33.42h-16.08V27.16c0-5.36-4.37-9.76-9.76-9.76H72c-5.36 0-9.79 4.38-9.76 9.76v108.86c-5.54.98-10.92 2.41-16.11 4.26V11.05C46.13 4.96 51.1 0 57.18 0zM69.9 263.43h20.68v16.51H69.9v-16.51zm20.68-9.27H69.9c-1.48-18.09-3.84-21.32-4.84-33.11-1.01-11.88-1.72-28.91 15.22-28.91 17.74 0 16.32 18.98 14.98 31.25-1.11 10.11-3.28 13.93-4.68 30.77zm-10.6-98.2c44.16 0 79.97 35.81 79.97 79.98 0 44.16-35.81 79.97-79.97 79.97C35.81 315.91 0 280.1 0 235.94c0-44.17 35.81-79.98 79.98-79.98zm310.83-88.93h107.34c7.62 0 13.85 6.22 13.85 13.85v247.94c0 7.61-6.23 13.84-13.85 13.84H390.81c-7.62 0-13.85-6.23-13.85-13.84V80.88c0-7.63 6.23-13.85 13.85-13.85zm86.63 58.4h12.74v4.64h-12.74v-4.64zm-32.97 159.92c8.3 0 15.05 6.74 15.05 15.04 0 8.31-6.75 15.06-15.05 15.06s-15.05-6.75-15.05-15.06c.02-8.3 6.75-15.04 15.05-15.04zm-48.76-173.04h97.54c1.6 0 2.89 1.3 2.89 2.88v17.79a2.91 2.91 0 0 1-2.89 2.89h-97.54c-1.6 0-2.89-1.31-2.89-2.89v-17.79a2.89 2.89 0 0 1 2.89-2.88zm-41.88 172.07H169.1c7.17-13.13 11.53-28 12.24-43.8h172.49v43.8zM199.3 299.64h100.27c.26 17.34 7.41 32.89 26.76 45.1H172.54c15.48-11.22 26.83-24.86 26.76-45.1z"/></svg>

            <h1 class="text-main dark:text-main mb-6 text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">@yield("title")</h1>
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl mb-12 text-center">@yield("message")</p>
        </div>
    </div>

</main>

@include("footer")
