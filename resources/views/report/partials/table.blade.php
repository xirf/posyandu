@php
 
    $headers = [
        
        'Name',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
        'Age',
    ];
@endphp
<div>
    <div>
        @livewire('Tables', ['headers' => $headers, 'rows' => $medicalRecords])
    </div>
</div>
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
{{-- <x-mary-table :headers="$headers" :rows="$medicalRecords" striped @row-click="alert($event.detail.name)" /> --}}