<ul class="list">
    <li class="header">Menu</li>
    <li class="active">
        <a href="{{ route('home') }}">
            <i class="material-icons">home</i>
            <span>Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="{{ route("mission.liste") }}">
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
                <a href="{{ route("reparation.liste") }}">
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
                <a href="{{ route("partenaire.liste",['type' => \App\Partenaire::CLIENT]) }}">
                    <span>Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route("partenaire.liste", ['type' => \App\Partenaire::FOURNISSEUR]) }}">
                    <span>Fournisseurs</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">monetization_on</i>
            <span>Factures</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="{{ route("facturation.liste.proforma") }}">
                    <span>Pro forma</span>
                </a>
            </li>
            <li>
                <a href="{{ route("facturation.liste.facture") }}">
                    <span>Factures</span>
                </a>
            </li>
            <li>
                <a href="{{ route("facturation.liste.all") }}">
                    <span>Toutes les factures</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">redeem</i>
            <span>Produits</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="{{ route("stock.produit.liste") }}">Liste</a>
            </li>
            <li>
                <a href="{{ route("stock.produit.famille") }}">Famille</a>
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
                <a href="#">Morris</a>
            </li>
            <li>
                <a href="#">Flot</a>
            </li>
            <li>
                <a href="#">ChartJS</a>
            </li>
            <li>
                <a href="#">Sparkline</a>
            </li>
            <li>
                <a href="#">Jquery Knob</a>
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
                <a href="{{ route("admin.utilisateur.liste") }}">Utilisateurs</a>
            </li>
            <li>
                <a href="{{ route('admin.chauffeur.liste') }}">Chauffeurs</a>
            </li>
        </ul>
    </li>

    <!--
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
    -->
</ul>