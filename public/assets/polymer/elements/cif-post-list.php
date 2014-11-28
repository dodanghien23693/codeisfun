
<?php include 'assets/polymer/elements/cif-post.php'; ?>
<polymer-element name="cif-post-list" >
    <template>
        <ul >
            <template repeat="{{ post in posts }}">
                <li class="container">
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