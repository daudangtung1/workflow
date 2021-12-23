@extends('manager.app')

@push('scripts')
<script>
    $('body').removeClass('sidebar-collapse');
    $('body').addClass('sidebar-open');
</script>
@endpush