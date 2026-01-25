
    <?php
        foreach ($data as $key => $value) {
            $nomUser = $value['nom_user'];
            $message = $value['nom_message']; 
            $date = $value['date'];

            echo "<section>
            <article >";
            echo "<h4>
            <span class='user-info'>Posté $nomUser</span> 
            <span class='date-info'>$date </span>
            </h4>";
            echo "<p>$message</p>";
            echo "</article>
            </section>
            "
            ;
        }

