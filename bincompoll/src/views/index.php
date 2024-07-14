
<body>
    <main>
    <div class="modal">
    <h2>Display the results of any individual polling unit</h2>
    <section id="control-area" >
        <form method="POST" action=<?="/".SITE_NAME."/getPollingUnitResults"?>>
           
            <label for="unit-selection">Please select a unit</label>
           
            <select id="unit-selection" name="polling_unit">
                <?php foreach($polling_units as $polling_unit):?>
                    <option value=<?=$polling_unit["uniqueid"]?>><?=$polling_unit["polling_unit_name"]?></option>
                <?php endforeach;?>
            </select>
            
            <input type="submit" value="Get result" id="get_result_btn">
        </form>
    </section>
   
    <section id="result-area">
        
            <?php if(isset($results) && count($results) == 0):?>
               <p>Sorry, no result for this polling unit </p>
            <?php endif; ?>

            <?php if( isset($results) && count($results) > 0):?>
                <table>
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Entered by </th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($results as $result):?>
                    <tr>
                        <td><?=$result["party_abbreviation"]?></td>
                        <td><?=$result["entered_by_user"]?></td>
                        <td><?=$result["party_score"]?></td>
                        <td><?=$result["date_entered"]?></td>
                    <tr> 
                    <?php endforeach;?>
            </tbody>
        </table>
            <?php endif; ?>

    <section>
    </div>
    
    </main> 
   
</body>
