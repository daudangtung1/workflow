@extends('staff.app')

@push('scripts')
    <script>
        setTimeout(() => {
            $('body').removeClass('sidebar-collapse');
            $('body').addClass('sidebar-open');
        }, 500);
    </script>
@endpush
