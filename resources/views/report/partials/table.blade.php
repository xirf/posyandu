<div class="w-full bg-white shadow-md rounded-lg p-6">
    <div class="overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols" id="table">
            <thead>
                <tr>
                    <th></th>
                    <td>Name</td>
                    <td>Job</td>
                    <td>company</td>
                    <td>location</td>
                    <td>Last Login</td>
                    <td>Favorite Color</td>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <td>Name</td>
                    <td>Job</td>
                    <td>company</td>
                    <td>location</td>
                    <td>Last Login</td>
                    <td>Favorite Color</td>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@pushOnce('script')
    <script>
        const table = document.getElementById('table');

        console.log("asd")

        window.onload = function() {
            axios.get('{{ route('api.medical.records') }}', {
                headers: {
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(console.log)
            .catch(console.error)
        }
    </script>
@endPushOnce
