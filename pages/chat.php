<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>

<section>
    <div class="top">
        <p>Eval mini Chat</p>
        <a href="/index.php?p=form&a=disconnect">déconnexion</a>
    </div>

    <div class="messages">
        <div class="received">
            <div>
                <p>Le message reçu</p>
            </div>
        </div>

        <div class="sent">
            <div>
                <p>message envoyé</p>
            </div>
        </div>
    </div>

    <div class="bottom">
        <textarea name="message" id="message" cols="30" rows="1"></textarea>
        <input type="submit" name="submit" id="new_message">
    </div>
</section>
