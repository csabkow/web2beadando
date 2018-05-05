<div class="content cars">
    <ul class="review-list">
        <?php
            $database = Database::getInstance();
            $req = $database->prepare("SELECT * FROM reviews JOIN users USING(user_id) ORDER BY insert_date DESC");
            $req->execute();
            foreach($req->fetchAll() as $review) {
                echo '<li class="reviews">';
                echo '<div class="about">';
                    echo '<p class="name">' . $review["username"] . '</p>';
                    echo '<p class="date">' . $review["insert_date"] . '</p>';
                    echo '<p class="description">' . $review["review"] . '</p>';
                echo '</div>';
                echo '</li>';
            }
        ?>
        
        <li class="reviews">
            <div class="about">
                <p>Vélemény írása</p>
                <textarea style="resize: none; width: 400px; height: 80px;" class="review-text"></textarea>
                <input type="submit" value="Küldés" id="add" />
            </div>
        </li>
    </ul>
</div>



