@stack('script')
@vite(['resources/js/app.js','resources/js/layout.js','resources/js/pages/project-task-form.js'])
<script type="importmap">
    {
      "imports": {
        "jquery": "/node_modules/jquery/dist/jquery.min.js"
      }
    }
</script>
<script type="module" src="{{asset('js/custom.js')}}"></script>
@yield('script-bottom')
