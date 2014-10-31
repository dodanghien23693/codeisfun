

<!-- initialize jQuery Library -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{URL::to("assets/public/default/js/jquery-1.8.1.min.js")}}"><\/script>')</script>
<!-- Modernizr -->
<script type="text/javascript" src="{{URL::to("assets/public/default/js/modernizr.custom.14583.js")}}"></script>
<!-- Superfish Menu -->
<script type="text/javascript" src="{{URL::to("assets/public/default/js/superfish.js")}}"></script>


@section('scripts')
    {{-- Here goes the page level scripts and plugins --}}
@show
