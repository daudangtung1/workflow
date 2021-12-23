@extends('manager.app')

@push('scripts')
<script>
    $('body').removeClass('sidebar-collapse');
    $('body').addClass('sidebar-open');
    $('.role-name').addClass('menu-is-opening');
        $('.role-name').addClass('menu-open');
        $('.role-name .nav-treeview').css('display', 'block');
</script>
@endpush