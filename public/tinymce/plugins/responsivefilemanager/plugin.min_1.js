tinymce.PluginManager.add("responsivefilemanager",function(e){function t(n){if(e.settings.external_filemanager_path.toLowerCase().indexOf(n.origin.toLowerCase())===0){if(n.data.sender==="responsivefilemanager"){tinymce.activeEditor.insertContent(n.data.html);tinymce.activeEditor.windowManager.close();if(window.removeEventListener){window.removeEventListener("message",t,false)}else{window.detachEvent("onmessage",t)}}}}function n(){e.focus(true);var n="RESPONSIVE FileManager";if(typeof e.settings.filemanager_title!=="undefined"&&e.settings.filemanager_title){n=e.settings.filemanager_title}var r="key";if(typeof e.settings.filemanager_access_key!=="undefined"&&e.settings.filemanager_access_key){r=e.settings.filemanager_access_key}var i="";if(typeof e.settings.filemanager_sort_by!=="undefined"&&e.settings.filemanager_sort_by){i="&sort_by="+e.settings.filemanager_sort_by}var s="false";if(typeof e.settings.filemanager_descending!=="undefined"&&e.settings.filemanager_descending){s=e.settings.filemanager_descending}var o="";if(typeof e.settings.filemanager_subfolder!=="undefined"&&e.settings.filemanager_subfolder){o="&fldr="+e.settings.filemanager_subfolder}var u="";if(typeof e.settings.filemanager_crossdomain!=="undefined"&&e.settings.filemanager_crossdomain){u="&crossdomain=1";if(window.addEventListener){window.addEventListener("message",t,false)}else{window.attachEvent("onmessage",t)}}win=e.windowManager.open({title:n,file:e.settings.external_filemanager_path+"dialog.php?type=4&descending="+s+i+o+u+"&lang="+e.settings.language+"&akey="+r,width:860,height:570,inline:1,resizable:true,maximizable:true})}e.addButton("responsivefilemanager",{icon:"browse",tooltip:"Insert file",shortcut:"Ctrl+E",onclick:n});e.addShortcut("Ctrl+E","",n);e.addMenuItem("responsivefilemanager",{icon:"browse",text:"Insert file",shortcut:"Ctrl+E",onclick:n,context:"insert"})})