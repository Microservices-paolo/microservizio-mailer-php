


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./mailertwo.php" method="post">
        
        <input 
            type="email" 
            name="email" 
            id="email" 
            required
        >
        <label for="name">EMAIL</label>
        
        <div class="input">
            <div class="inputGroup">
                <input 
                    autocomplete="on"
                    type="text" 
                    id="name"
                    name="name"
                    required
                >
                <label for="name">NOME E COGNOME</label>
            </div>
        </div>
        <div class="input">
            <div class="inputGroup">
                <input 
                    autocomplete="on" 
                    type="text"
                    id="telephone" 
                    name="telephone"
                >
                <label for="telephone">TELEFONO</label>
            </div>
        </div>
        <div class="type_contact">
            <div class="text_contact">
                <span>Come preferisci essere contattato?</span>
            </div>
            <div class="container_input_radio">
                <span>
                    <input 
                        type="radio" 
                        class="input_radio" 
                        name="contact" 
                        value="email"
                    >
                    Email
                </span>
                <span>
                    <input 
                        type="radio" 
                        class="input_radio" 
                        name="contact" 
                        value="telefono"
                    >
                    Telefono
                </span>
            </div>

            <div class="accept_conditions">
        
                <input type="checkbox" name="sendMail" id="sendMail">
               
                <span class="text_accept">Ho letto e accetto la politica sulla privacy ai sensi del Regolamento EU n. 679/2016</span>
            </div>
        </div>

        <button type="submit">Invia</button>
    </form>
</body>
</html>





