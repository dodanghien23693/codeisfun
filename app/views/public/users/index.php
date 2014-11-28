<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <link rel="import" href="<?php echo asset("assets/polymer/bower_components/polymer/polymer.html") ?>">
    
  </head>
  
  <body>
  
<polymer-element name="polymer-cool" >
  <template>
 
      <template repeat="{{user in users }}">
          {{user.username}}:{{user.email}}
      </template>
 
  </template>
    <script>
        Polymer({
            users: <?php echo json_encode($users);?>
        });
    </script>
</polymer-element>

  
 <polymer-cool ></polymer-cool>

  </body>
</html>
