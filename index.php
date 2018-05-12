<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Buyers</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="theme-color" id="statusBar" content="#212121">
    <meta name="HandheldFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="Plateforme web qui met en réseau achéteurs et vendeurs de produits neufs et occasions">
    <meta name="author" content="Buyers">
    <meta name="viewport" content="width=device-width, height=device-height, minimum-scale=1.0, initial-scale=1, maximum-scale=3 user-scalable=no">
    <!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/againstie.css" />
    <![endif]-->
    <link rel="icon" type="image/png" href="img/favicon.jpg" />
    <link rel="stylesheet" href="css/sharestyles.css" media="all" onload="if(media!='all')media='all'">
    <link rel="stylesheet" href="css/index.css" media="all" onload="if(media!='all')media='all'">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body id="body">
<span id="geolocData" data-lat="" data-lon=""></span>
<!-- bloc de mise a jour -->
<div id="updateMessage"></div>
<header>
  <span id="id_Logo">BUYERS</span>
  <div id="right_float">
   <!--<span>Inscription</span>
   <span>Connexion</span>-->
   <span id="en">En</span><span id="fr">Fr</span>
  </div>
</header>
<nav id="menu">
 <!--<span id="logo" class="bgCover">Logo</span>-->
 <span id="depotAnnonce"><svg class="iconSvg firstIconSvg" fill="#212121" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg> Deposer une annonce gratuitement</span>
 <span><svg class="iconSvg" fill="#212121" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
</svg> Voir les annonces</span>
 <span><svg class="iconSvg" fill="#212121" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/>
</svg> Foire aux questions</span>
 <span><svg class="iconSvg" fill="#212121" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/>
    <path d="M20 0H4v2h16V0zM4 24h16v-2H4v2zM20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-8 2.75c1.24 0 2.25 1.01 2.25 2.25s-1.01 2.25-2.25 2.25S9.75 10.24 9.75 9 10.76 6.75 12 6.75zM17 17H7v-1.5c0-1.67 3.33-2.5 5-2.5s5 .83 5 2.5V17z"/>
</svg> Nous contacter</span>
</nav>
<section id="wrapperSlider">
</section>
<section id="title_recherch">RECHERCHER UNE ANNONCE</section>
<section id="search_zone">
 <input type="search" id="search_by_name" placeholder="Entrez un nom de produit" />
 <select id="search_by_category">
  <option value="" selected data-default>Choisir une categorie</option>
  <option disabled>--Emploi--</option>
  <option value="offre-emploi">Offre d'emploi</option>
  <option disabled>--Informatique--</option>
  <option value="telephone">Télephone</option>
  <option value="ordinateur">Ordinateur</option>
  <option value="tablette">Tablette</option>
  <option value="console-de-jeu">Console de jeu</option>
  <option value="accesessoire-informatique">Accesessoire informatique</option>
  <option disabled>--Mode--</option>
  <option value="vetement">Vêtement</option>
  <option value="chaussure">Chaussure</option>
  <option disabled>--Maison/Terrain--</option>
  <option value="terrain">Terrain</option>
  <option value="appartement">Apartement</option>
  <option value="maison">Maison</option>
  <option value="autre">Autre</option>
 </select>
 <select id="search_by_city">
  <option value="" selected data-default>Choisir une ville</option>
  <option value="Bamenda">Bamenda</option>
         <option value="Bafoussam">Bafoussam</option>
         <option value="Bangante">Banganté</option>
         <option value="Bertoua">Bertoua</option>
         <option value="Buea">Buea</option>
         <option value="Douala">Douala</option>
         <option value="Dschang">Dschang</option>  
         <option value="Ebolowa">Ebolowa</option>
         <option value="Edea">Edea</option>
         <option value="Garoua">Garoua</option>
         <option value="Kribi">kribi</option>
         <option value="Maroua">Maroua</option>
         <option value="Nkongsamba">Nkongsamba</option>
         <option value="Ngaoundere">Ngaoundéré</option>
         <option value="Limbe">Limbé</option>
         <option value="Sangmelima">Sangmélima</option>
         <option value="Yaounde">Yaoundé</option>
  
 </select>
 <button id="search_simple">RECHERCHER</button>
 <button id="search_geolocation">RECHERCHER DES ANNONCES DANS MA REGION</button>
</section>
<section id="search_results">
</section>
<footer id="_footer">
<span id="depotAnnonce">Deposer une annonce gratuitement</span>
<span>Voir les annonces</span>
 <span>Foire aux questions</span>
 <span>Nous contacter</span>
 <span>&copy; copyright 2018 softbay</span>
</footer>
</body>
<script src="js/index.js"></script>
<script src="js/popUp.js"></script>
</html>