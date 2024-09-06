<div class="p-4 bg-white shadow sm:rounded-lg min-h-screen">
    <x-quill 
    label="Body" name="body" value="" placeholder="Content here..." 
    :endpoint="'/uploads'"
    />

</div>

@pushOnce('script')
    <script>
        fetch('{{route("get.images")}}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => response.json()).then(console.log)
    </script>
@endPushOnce
