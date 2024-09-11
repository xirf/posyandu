@php
    $users = \App\Models\MedicalRecordModel::with('patient')->paginate(10);

    $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
        ['key' => 'patient.name', 'label' => 'Name'],
        ['key' => 'patient.birth_date', 'label' => 'Tanggal Lahir'],
        ['key' => 'height', 'label' => 'Height'],
        ['key' => 'weight', 'label' => 'Weight'],
        ['key' => 'arm_circumference', 'label' => 'Arm Circumference'],
        ['key' => 'head_circumference', 'label' => 'Head Circumference'],
        ['key' => 'abd_circumference', 'label' => 'Abd Circumference'],
        ['key' => 'family_planning', 'label' => 'Family Planning'],
        ['key' => 'hypertension', 'label' => 'Hypertension'],
        ['key' => 'diabetes', 'label' => 'Diabetes'],
        ['key' => 'complaint', 'label' => 'Complaint'],
        ['key' => 'therapy', 'label' => 'Therapy'],
        ['key' => 'age_category', 'label' => 'Age Category'],
    ];

@endphp

{{-- Notice `with-pagination` --}}
<x-mary-table :headers="$headers" :rows="$users" with-pagination />
