<link rel='import' href="<?php echo asset('assets/polymer/elements/cif-post.html') ?>">
<polymer-element name="cif-post-list" >
    <template>
        <ul >
            <template repeat="{{ post in posts }}">
                <li>
                <cif-post post='{{ post }}'>

                </cif-post>

                </li>

            </template>
        </ul>

    </template>
    <script>
        Polymer({
            posts : <?php echo json_encode($posts) ?>
        });
    </script>
</polymer-element>