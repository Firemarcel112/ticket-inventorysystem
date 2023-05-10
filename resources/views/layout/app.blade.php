@include("head", ["title" => "$pageTitle"])

<main>
    @include("component.header")
    @include("component.sidebar")

    @yield("outerApp")

    <div class="app">
        @include("component.message.information")
        @include("component.message.success")
        @include("component.message.error")
        @include("component.message.warning")
        @yield("content")
    </div>

</main>

    @include("component.footer")
</body>
</html>
