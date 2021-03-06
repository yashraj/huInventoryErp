<?php $this->load->view('common/menu'); ?>

<head>
    <meta charset="UTF-8">
	<title>
		<?php
			echo $title;
		?>
	</title>
    <link rel="import" href="http://www.polymer-project.org/components/paper-ripple/paper-ripple.html">
    <link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
    <link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">
</head>
<body>
	<?php 
		//var_dump($allInformation);
		$stack[100] = array();
		$tos = -1;
		$stack[++$tos] = "0";
		$count = 0;
	?>
	<form name="editthisroleform" id="editthisroleform" onsubmit="return updaterole()" method="post">
		<fieldset>
		<h3>Edit Role</h3>
		Role ID: <br /><input type="text" name="roleid" id="roleid" readonly value="<?php echo $allInformation[0]['roleid'];?>">
    	<br />
    	<br />
		Role name: <br /><input type="text" name="rolename" id="rolename" size="34" value="<?php echo $allInformation[0]['rolename'];?>">
		<br />
		<br />
		
		Role Description: <br /><textarea name="roledesc" id="roledesc" rows="5" cols="36"><?php echo $allInformation[0]['role_description'];?></textarea>
  		<br />
		<br />
		
		Role Status: 
		<br />
		<input type="radio" name="isactive" id='active' value="1" 
		<?php 
    		if($allInformation[0]['isactive'])
    			echo 'checked';
    		?>
    	>Active
		<br/>
		<input type="radio" name="isactive" id='inactive' value="0" 
		<?php 
    		if(!$allInformation[0]['isactive'])
    			echo 'checked';
    	?>
    	>Inactive
		<br />
		<br />
  		
  		Panels: <br />
                <ul id="checktree">
  		<?php 
		while($count < count($panelsArray))
		{	
			$flag = 0;
			for ($i=0; $i <= count($panelsArray) - 1; $i++)
			{     					  	
				if ($panelsArray[$i]['panel_parent_id'] != $stack[$tos])
			  		continue;
			  	else 
              	{
              		$stack[++$tos] = $menuPanelsArray[$i]['panel_id'];
              		$panelsArray[$i]['panel_parent_id'] = -1;
              		$flag = 1;
              		$count++;
        ?>
                
        <li  class='active has-sub'>
        <input type="checkbox" name="panel" value="<?php echo $panelsArray[$i]['panel_id']; ?>" <?php 
        for($j = 0; $j<count($allInformation[1]); $j++)
        {
        	if($panelsArray[$i]['panel_id'] == $allInformation[1][$j]['panel_id'])
        	{
        		echo 'checked';
        		break;
        	}
        }
        ?>><?php echo $panelsArray[$i]['panel_name']; ?>
        <br/>
			<ul>
		<?php 
              			break;	
              	}
			}
			if(!$flag)
			{
             	--$tos;
        
	   ?>
			</ul>
        </li>
		<?php 
			}
		}
		?>
  		</ul>
  		
                <div class="button raised blue">
                <a onclick="updaterole();">
                <br />
                <br />
                <br />
                <fieldset><div class="center">Update Role</div></fieldset>
                
                <paper-ripple fit></paper-ripple></a>
                </div>
		</fieldset>
	</form>

    <script src = "public/js/default.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>-->
    <script src = "./public/jquery/jquery.checkboxtree.js"></script>
    <link rel="stylesheet" type="text/css" href="public/jquery/jquery.checkboxtree.css">
    <script>
    $('#checktree').checkboxTree();
    </script>
</body>