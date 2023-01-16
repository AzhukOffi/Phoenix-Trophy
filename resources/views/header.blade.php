<nav id="sidebar" class="sidebar" role="navigation">
    <div class="js-sidebar-content">
        <br><header class="phoenix-logo logo ">

        </header>

        <ul class="sidebar-nav">
            <li class=" active ">
                <ul id="sidebar-dashboard" class="show ">
                    <li class=""><a href="/home"><span class="material-icons">home</span> &nbspAccueil</a></li>
                    <li class=""><a href="/pari"><span class="material-icons">credit_card</span> &nbspPari</a></li>
                    <li class=""><a href="/vote"><span class="material-icons">how_to_vote</span> &nbspSondage</a></li>

                    <?php
                    if ($user != null && $user["admin"] == 1) {
                      echo '<li class=""><a href="/admin"><span class="material-icons">admin_panel_settings</span> &nbspAdmin</a></li>';
                    }
                     ?>
                </ul>

            </li>
        </ul>
    </div>
</nav>
