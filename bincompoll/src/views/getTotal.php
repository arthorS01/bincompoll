
<body>
    <main>
    <div class="modal">
    <h2>Display the sum total from a particular L.G.A</h2>
    <section id="control-area">
        <form method="POST" action=<?="/".SITE_NAME."/getTotal"?>>
           <label>Select L.G.A</label>
          
           <select name="lga-selection">
            <?php foreach($allLga as $lga) :?>
                    <option value=<?=$lga["lga_id"]?>><?=$lga["lga_name"]?></option>
            <?php endforeach; ?>
           </select>
           <input type="submit" value="Get total">
        </form>
    </section>
   
    <section id="result-area">
        <?php if($method == "post"):?>
        <table>
            <thead>
                <tr>
                    <th>Polling  unit name</th>
                    <th>Party</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($filtered_lga as $lga): ?>
                    <tr>
                        <td><?=$lga["polling_unit_name"]?></td>
                        <td><?=$lga["party_abbreviation"]?></td>
                        <td><?=$lga["party_score"]?></td>
                    </tr>
                <?php  endforeach; ?>
                <tr>
                    <td><strong>Total score</strong></td>
                    <td></td>
                    <td><?=$sum?></td>
                </tr>
            </tbody>
        </table>
        
        <?php endif; ?>

    <section>
    
    </div>
    </main> 
   
</body>
