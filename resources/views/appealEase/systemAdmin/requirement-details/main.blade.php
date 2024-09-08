<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="/css/app.css" rel="stylesheet">
    {{-- TABLE SCRIPT FOR SEARCH, ENTITIES, NEXT AND PREV --}}
    <script>
        $(document).ready(function() {
            $('#civilTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#criminalTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#specialTable').DataTable();
        });
    </script>
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @include('appealEase.systemAdmin.navigation-menu')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                Requirement Details
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{-- Popup Message --}}
            @if (session('success'))
                <script type="text/javascript">
                    $(document).ready(function() {
                        alert('{{ session('success') }}');
                    });
                </script>
            @endif
            <div class="container my-3">
                <div class="mb-3">@include('appealEase.systemAdmin.requirement-details.addRequirements')</div>
            
            @include('appealEase.systemAdmin.requirement-details.caseRequirementTabs') 
            @include('appealEase.systemAdmin.requirement-details.editRequirements')
            </div>

        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var requirement_name = $(this).data('requirement_name');
                var description = $(this).data('description');

                $('#editId').val(id);
                $('#editRequirementName').val(requirement_name);
                $('#editDescription').val(description);

                $('#editForm').attr('action', '/requirement-details/' + id);
                $('#editRequirementDetails').modal('show');
            });
        });
    </script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete?");
        }
    </script>
</body>

</html>
