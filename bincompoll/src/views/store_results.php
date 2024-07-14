<main>
    <div class="modal">
        <h2>Store results for new polling unit</h2>
       <form id="polling_form" method="POST" action=<?="/".SITE_NAME."/addScore"?>>
        
       <?php
            if(isset($_SESSION["success"])){
                echo "<h3>".$_SESSION["success"]."</h3>";
            }
        ?>
        
            

                <div id="Polling_unit_details">
                
                <div class="field">
                    <select name="lga_id">
                        <?php foreach($allLga as $lga):?>
                            <option value=<?=$lga["lga_id"]?> ><?=$lga["lga_name"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="field">
                    <select name="ward">
                        <?php foreach($allWard as $ward):?>
                            <option value=<?=$ward["ward_id"]?> ><?=$ward["ward_name"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                    <div class="field">
                        <input type="text" placeholder="unit number" name="unit_number" >
                        
                    </div>        
                    <div class="field">
                        <input type="text" placeholder="unit name" name="unit_name" >
                        <span class="error">
                        <?php
                            if(isset($_SESSION["errors"]["unit_name"])){
                                echo $_SESSION["errors"]["unit_name"][0];
                            }
                        ?>
                        </span>
                     </div>        
                    <div class="field">
                        <input type="text" placeholder="describe the unit" name="polling_unit_description">
                        <span class="error">
                        <?php
                            if(isset($_SESSION["errors"]["polling_unit_description"])){
                                echo $_SESSION["errors"]["polling_unit_description"][0];
                            }
                        ?>
                        </span>   
                    </div> 
                    <div class="field">
                        <input type="text" placeholder="Enter agent name" name="agent_name">
                        <span class="error">
                        <?php
                            if(isset($_SESSION["errors"]["agent_name"])){
                                echo $_SESSION["errors"]["agent_name"][0];
                            }
                        ?>
                        </span>
                    </div> 
                    <div class="field">
                        <input type="email" placeholder="Enter agent email" name="agent_email">
                        <span class="error">
                        <?php
                            if(isset($_SESSION["errors"]["agent_email"])){
                                echo $_SESSION["errors"]["agent_email"][0];
                            }
                        ?>
                    </div>
                    
                    <input type="submit" value="Add result">
                </div>

               
                <div id="Result-details">
                
                <div class="field">
                    <?php foreach($allParty as $party):?>
                    <div class="result-row">
                            <label><?= $party["partyname"]?></label>
                            <input type="number" placeholder="score" name=<?=$party["partyname"]."_score"?>>
                    </div>
                   <?php endforeach; ?>
                  
                </div>
                  
                </div>
   
       </form>  
    </div>
</main>
<?php 
session_destroy();
?>