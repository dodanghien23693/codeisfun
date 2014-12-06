<html>
  <head>

    <link href="/assets/jtable/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="/assets/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />

   <script src="/assets/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="/assets/jtable/jquery.jtable.js" type="text/javascript"></script>
	<script src="/assets/tbdrag/jquery.tablednd.js" type="text/javascript"></script>
  </head>
  <body >
      <div class="drag">
	<div id="PeopleTableContainer" style="width: 600px;"></div>
      </div>
        <div id="drag">
            <table >
                <thead>
                    <tr>
                        <th> cot 1</th>
                        <th> cot 1</th>
                        <th> cot 1</th>
                        <th> cot 1</th>
                        <th> cot 1</th>
                        <th> cot 1</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr >
                        <td class="rowhandler">
                            <div class="drag row" ></div>
                        </td>
                        <td ></td>
                        <td></td>
                        <td>
                           Drag
                        </td>
                        <td></td>
                        <td ></td>
                    </tr>

                    <tr >
                        <td class="rowhandler">
                            <div class="drag row" ></div>
                        </td>
                        <td ></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td ></td>
                    </tr>
                </tbody>
            </table>    
        </div>
      <input type="button" id="event-btn" value="lick me">
      <script>
        $("#event-btn").click(function(e){
            console.log('ban vua click vao button');
           
        });
      </script>
     <div id="PeopleTableContainer2" style="width: 600px;"></div>
    
	<script type="text/javascript">

		$(document).ready(function () {
                    
                    
                    $("table").tableDnD();
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of courses',
				actions: {
					listAction: '<?php echo url('admin/course')?>?action=list',
					createAction: '<?php echo url('admin/course')?>?action=create',
					updateAction: '<?php echo url('admin/course')?>?action=update',
					deleteAction: '<?php echo url('admin/course')?>?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					name: {
						title: 'Name',
						width: '40%',
                                                options : '<?php echo url('admin/course/get-list-chapter'); ?>'
					},
                                        short_name: {
						title: 'short_name',
						width: '20%'
					},
					start_day: {
						title: 'Start_day',
						width: '20%',
                                                type : 'date'
					},
					end_day: {
						title: 'end_day',
                                                width: '20%',
                                                type : 'date'
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');
                        
                       

		});
                

	</script>
 
  </body>
</html>
