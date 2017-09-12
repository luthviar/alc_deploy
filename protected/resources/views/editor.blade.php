//Step 1: Register Editor component to your page   
<?php require_once "cuteeditor_files/include_CuteEditor.php" ?>   
<html>   
<body>   
        <form id="form1" method="POST">   
            <?php   
                //Step 2: Create Editor object.   
                $editor=new CuteEditor();   
                $editor->Text="Type here";    
                //Step 3: Set a unique ID to Editor   
                $editor->ID="Editor1";    
                $editor->AutoConfigure="Simple";
                
                //Step 4: Render Editor   
                $editor->Draw();   
            ?>   
        </form>   
</body>   
</html>  