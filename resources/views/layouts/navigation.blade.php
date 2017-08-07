<ul class="list">
    <li class="header">Menu</li>
    <li class="active">
        <a href="{{ route('home') }}">
            <i class="material-icons">home</i>
            <span>Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);">
            <i class="material-icons">business_center</i>
            <span>Missions</span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">drive_eta</i>
            <span>Véhicules</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="{{ route("vehicule.liste") }}">
                    <span>Liste</span>
                </a>
            </li>
            <li>
                <a href="{{ route("vehicule.reparation") }}">
                    <span>Réparations</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">people</i>
            <span>Clients et fournisseurs</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="javascript:void(0);">
                    <span>Clients</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <span>Forunisseurs</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">monetization_on</i>
            <span>Commandes et factures </span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="javascript:void(0);">
                    <span>Commandes</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <span>Factures</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">pie_chart</i>
            <span>Etats</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="pages/charts/morris.html">Morris</a>
            </li>
            <li>
                <a href="pages/charts/flot.html">Flot</a>
            </li>
            <li>
                <a href="pages/charts/chartjs.html">ChartJS</a>
            </li>
            <li>
                <a href="pages/charts/sparkline.html">Sparkline</a>
            </li>
            <li>
                <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">settings</i>
            <span>Administration</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="{{ route('admin.employe.liste') }}">Employes</a>
            </li>
            <li>
                <a href="#">Utilisateurs</a>
            </li>
            <li>
                <a href="{{ route('admin.chauffeur.liste') }}">Chauffeurs</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">trending_down</i>
            <span>Multi Level Menu</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="javascript:void(0);">
                    <span>Menu Item</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <span>Menu Item - 2</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <span>Level - 2</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Level - 3</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Level - 4</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
        <a href="pages/changelogs.html">
            <i class="material-icons">update</i>
            <span>Changelogs</span>
        </a>
    </li>
    <li class="header">Informations</li>
    <li>
        <a href="javascript:void(0);">
            <i class="material-icons col-red">donut_large</i>
            <span>Important</span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);">
            <i class="material-icons col-amber">donut_large</i>
            <span>Warning</span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);">
            <i class="material-icons col-light-blue">donut_large</i>
            <span>Information</span>
        </a>
    </li>
</ul>