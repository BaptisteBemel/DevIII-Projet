<!DOCTYPE html>
<html>
<head>
    <link href="https://bootswatch.com/4/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="font-size: 25px;">
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <!--Si non-connecté alors apparait le boutton-->
                    <li class="nav-item">
                        <a class="nav-link" href="/inscription">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/commentaires">Commentaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/messagerie">Messagerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 
                            is_granted('IS_AUTHENTICATED_FULLY') == false 
                            ? 'disabled'
                            }}" href="/">
                            Espace élève</a>
                    </li>
                </ul>
                <ul class="navbar-naw ml-auto">
                    <li class="nav-item">
                    <!--Si connecté alors boutton déco, sinon => connexion-->
                        <a class="nav-link" href="/deconnexion">Se déconnecter</a> 
                        <a class="nav-link" href="/connexion">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <h1>Vos messages</h1>
    <section>
        <div class="sectionMail">
            <div class="scrollListMail" id="mailList">
            </div> 
            <div class="contentMail" id="mailContenu">
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
    <script src="/js/messagerie.js"></script>

    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</body>
</html>