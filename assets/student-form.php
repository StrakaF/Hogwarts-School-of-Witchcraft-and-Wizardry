<!--Formulár na editovanie a pridávanie žiaka -->

<form method="POST">
    <input type="text" 
            name ="first_name" 
            placeholder="Krstné meno"
            value ="<?= htmlspecialchars($first_name) ?>"
            required>
    
    <input type="text"
            name ="second_name"
            placeholder="Priezvisko"
            value ="<?= htmlspecialchars($second_name) ?>"
            required>
    
    <input type="number"
            name ="age"
            min="10"
            placeholder="Aktuálny vek"
            value ="<?= htmlspecialchars($age) ?>"
            required>
    
    <input type="text"
            name ="college"
            placeholder="Názov internátu"
            value ="<?= htmlspecialchars($college) ?>"
            required>    

    <textarea name="life"
                placeholder="Podrobnosti o žiakovi"
                required><?= htmlspecialchars($life) ?></textarea>
    
    
        
    <input type="submit" value="Uložiť">
</form>

