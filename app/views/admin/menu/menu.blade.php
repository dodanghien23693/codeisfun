
@if (Auth::user()->isAdmin())
@include('admin.menu.admin-menu')
@endif  

@if (Auth::user()->isManager())
@include('admin.menu.manager-menu')
@endif  

@if (Auth::user()->isWriter())
@include('admin.menu.writer-menu')
@endif  

@if (Auth::user()->isUser())
@include('admin.menu.user-menu')
@endif  