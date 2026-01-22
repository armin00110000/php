<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitarbeiter </title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        h1 { color: #333; text-align: center; margin-top: 0; }
        
        label { display: block; margin-top: 15px; font-weight: bold; color: #555; }
        
        input[type="text"], select {
            width: 100%; padding: 10px; margin-top: 5px;
            border: 2px solid #ddd; border-radius: 8px; box-sizing: border-box;
        }
        
        .option-group { margin-top: 5px; display: flex; gap: 15px; flex-wrap: wrap; }
        .option-group label { margin-top: 0; font-weight: normal; display: flex; align-items: center; cursor: pointer; }
        
        input[type="radio"], input[type="checkbox"] { margin-right: 5px; transform: scale(1.2); }
        
        button {
            margin-top: 25px; width: 100%; padding: 12px;
            background-color: #0072ff; color: white; border: none;
            border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;
        }
        button:hover { background-color: #005bb5; }
    </style>
</head>
<body>

    <div class="card">
        <h1>👤 Mitarbeiter anlegen</h1>
        
        <form action="info.php" method="post" >

            <label>Vor- und Nachname:</label>
            <input type="text" name="vornachname" placeholder="Ihre Vor- und Nachname">

            <label>Abteilung:</label>
            <select name="abteilung">
                <option value="Entwicklung">IT & Entwicklung</option>
                <option value="Marketing" selected>Marketing & PR</option>
                <option value="Vertrieb">Sales & Vertrieb</option>
                <option value="Personal">Personalwesen (HR)</option>
            </select>

            <label>Vertragsart:</label>
            <div class="option-group">
                <label>
                    <input type="radio" name="vertragsart" value="Vollzeit" checked> Vollzeit
                </label>
                <label>
                    <input type="radio" name="vertragsart" value="Teilzeit"> Teilzeit
                </label>
            </div>

            <label>Hardware Ausstattung:</label>
            <div class="option-group">
                <label>
                    <input type="checkbox"  name="ausstattung[]" value="Laptop" > Laptop
                </label>
                <label>
                    <input type="checkbox" name="ausstattung[]" value="Smartphone"> Handy
                </label>
                <label>
                    <input type="checkbox" name="ausstattung[]" value="Monitor" > Monitor
                </label>
            </div>

            <button type="submit" name="speichern" >Speichern</button>
        </form>
    </div>

</body>
</html>