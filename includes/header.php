<header>
    <p class="main_logo"><a href="/">Satond - Blog</a></p>
    <div class="nav_menu">
        <ul class="menu">
            <li><a href="/articles">Articles</a> </li>

            <?php
                if ( isset($_SESSION['logged_user']) )
                {
                    echo '<li><a href="/logout.php">LogOut (' . $_SESSION["logged_user"]->login . ')</a> </li>';
                } else {
                    echo '<li><a href="/login/">Sign-In</a> </li>';
                }
            ?>
        </ul>
    </div>
</header>