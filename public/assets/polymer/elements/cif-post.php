
<polymer-element name="cif-post" attributes="post">
    <template>
        <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/fronted/bootstrap/css/bootstrap.min.css'); ?>" />
        <div class="row">
            <div class="col-sm-3">
                <img class="img-responsive" src="{{post.cover_image_url }}" />
            </div>
            <div class="col-sm-9">
                <h3>{{post.title}}</h3>
                {{ post.description}}
            </div>
        </div>
        <h1>{{post.title}}</h1>
    </template>
    <script>
        Polymer({
            
        });
    </script>
</polymer-element>

