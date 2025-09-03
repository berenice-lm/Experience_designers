// Définir la carte
var defaultZoom = 9;

var extent = ol.proj.transformExtent(
    [-1.25, 43, 0.9, 43.9], // Coordonnées en EPSG:4326 (lon/lat)
    'EPSG:4326', 
    'EPSG:3857' // Transformation vers la projection utilisée
);

new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms',
        params: { 'LAYERS': 'la_bonne_carte:fond_uni_vert_dep', 'TILED': true },
        serverType: 'geoserver'
    }),          
        })


var mapView = new ol.View({
    center: ol.proj.fromLonLat([0, 43.5]),
    zoom: defaultZoom,
    minZoom: 9,
    maxZoom: 16,
    extent: extent,
    constrainResolution: false
});

var map = new ol.Map({
    target: 'map',
    view: mapView
});

var zoomDiv = document.getElementById('zoom');
function updateZoomDisplay() {
    // Afficher le zoom avec 2 décimales
    var zoomLevel = map.getView().getZoom().toFixed(2); 
    zoomDiv.innerHTML = 'Zoom : ' + zoomLevel;
}

// Mettre à jour l'affichage à chaque changement de zoom
map.getView().on('change:resolution', updateZoomDisplay);
updateZoomDisplay(); // Initialisati

// FOND DE CARTE
var fondWMSLayer = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms',
        params: {
            'LAYERS': 'la_bonne_carte:fond_uni_vert_dep',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'Fond personnalisé' // Identifiant de la couche
});

//************ A RAJOUTER LAURE  ***************************
var routesWMSLayer = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:PlanIGN_n0_up',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'Routes',
    minZoom: 15,  
    maxZoom: 17,
});


var routesWMSLayer10 = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:PlanIGN_n10_up',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'Routes10',
    minZoom: 14,  
    maxZoom: 17,
});

var routesWMSLayer25 = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:PlanIGN_n25_reco',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'Routes25',
    minZoom: 12,  
    maxZoom: 17,
});

var routesWMSLayer50 = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:PlanIGN_n50_reco',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'Routes50',
    minZoom: 9,  
    maxZoom: 12,
});






var vegetaWMSLayer25 = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:vegetation_area_n25',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'veget25',
    minZoom: 12,  
    maxZoom: 17,
    
});


var vegetaWMSLayer50 = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms', // Remplacez par l'URL correcte
        params: {
            'LAYERS': 'la_bonne_carte:vegetation_area_n50',
            'TILED': true
        },
        serverType: 'geoserver'
    }),
    name: 'veget50',
    minZoom: 9,  
    maxZoom: 12,
    
});



// Ajouter la couche à la carte (sans suppression des autres couches)
map.addLayer(fondWMSLayer);
map.addLayer(vegetaWMSLayer25)
map.addLayer(vegetaWMSLayer50)
map.addLayer(routesWMSLayer50)
map.addLayer(routesWMSLayer25)
map.addLayer(routesWMSLayer10)
map.addLayer(routesWMSLayer)

//************************* FIN  ***************************


// Fonction pour mettre à jour la visibilité des couches en fonction du niveau de zoom
function updateLayerVisibility(layerChoices, layerPrefix) {
    const zoomLevel = Math.floor(map.getView().getZoom());
    console.log(`Zoom actuel : ${zoomLevel}`);
    console.log('Choix utilisateur : ', layerChoices);

    map.getLayers().forEach(function(layer) {
        if (layer.get('name') && layer.get('name').startsWith(layerPrefix)) {
            const selectedLayerForZoom = layerChoices[zoomLevel]; 
            if (layer.get('name') === selectedLayerForZoom) {
                layer.setVisible(true); 
            } else {
                layer.setVisible(false); 
            }
        }
    });
}

//Fonction pour charger les couches
// Fonction pour créer une couche WMS
function createLayer(Name, zIndex) {
    var source = new ol.source.TileWMS({
        url: 'https://lostinzoom.huma-num.fr/geoserver/wms',
        params: { 'LAYERS': `la_bonne_carte:${Name}`, 'TILED': false },
        serverType: 'geoserver'
    });
    var layer = new ol.layer.Tile({
        source: source,
        name: Name,
        visible: false // Départ invisible
    });
    layer.setZIndex(zIndex);
    return layer;
}


// TOPONYMES
var toponymes = [
    { name: 'points_zoom10', zIndex: 10 },
    { name: 'points_zoom11', zIndex: 10 },
    { name: 'points_zoom12', zIndex: 10 },
    { name: 'points_zoom13', zIndex: 10 },
    { name: 'points_zoom14', zIndex: 10 },
    { name: 'points_zoom15', zIndex: 10 },
    { name: 'points_zoom16', zIndex: 10 },
    { name: 'points_zoom17', zIndex: 10 },
    { name: 'points_zoom18', zIndex: 10 },
    { name: 'points_zoom8', zIndex: 10 },
    { name: 'points_zoom9', zIndex: 10 },
];

// Stocke les choix des utilisateurs pour chaque niveau de zoom
var userToponymChoices = {};


// Ajoute toutes les couches de toponymes à la carte au début
toponymes.forEach(toponym => {
    var layer = createLayer(toponym.name, toponym.zIndex);
    map.addLayer(layer);
});

document.querySelectorAll('.toponymSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); // Récupère le niveau de zoom depuis data-zoom
        const selectedToponym = event.target.value; // Couche sélectionnée

        // Stocke le choix utilisateur
        userToponymChoices[zoomLevel] = selectedToponym;

        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedToponym}`);

        // Mettre à jour la visibilité des couches
        updateLayerVisibility(userToponymChoices, 'points_zoom');
    });
});

// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibility(userToponymChoices, 'points_zoom');
});

// ZONES URBAINES
// Liste des zones urbaines avec leurs noms et zIndex
var urbanAreas = [
    { name: 'urban_area_zoom10', zIndex: 3 },
    { name: 'urban_area_zoom11', zIndex: 3 },
    { name: 'urban_area_zoom12', zIndex: 3 },
    { name: 'urban_area_zoom13', zIndex: 3 },
    { name: 'urban_area_zoom14', zIndex: 3 },
    { name: 'urban_area_zoom15', zIndex: 3 }
];

// Stocke les choix des utilisateurs pour chaque niveau de zoom
var userUrbanChoices = {}; 

// Ajoute toutes les couches de zones urbaines à la carte
urbanAreas.forEach(area => {
    var layer = createLayer(area.name, area.zIndex);
    map.addLayer(layer);
});

document.querySelectorAll('.urbanSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); 
        const selectedUrban = event.target.value; 

        // Stocke le choix utilisateur
        userUrbanChoices[zoomLevel] = selectedUrban;

        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedUrban}`);

        // Mettre à jour la visibilité des couches
        updateLayerVisibility(userUrbanChoices,'urban_area');
    });
});

// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibility(userUrbanChoices,'urban_area');
});


//HABITATION
var batiments = [
    { name: 'buildings_z17', zIndex: 5 },
    { name: 'buildings_z18', zIndex: 5 },
    { name: 'important_buildings', zIndex: 5 },
];
var userBuildingChoices = {}; 


// Ajoute les couches de bâtiments à la carte
batiments.forEach(bat => {
    var layer = createLayer(bat.name, bat.zIndex);
    map.addLayer(layer);
});

function updateLayerVisibilitybat() {
    const zoomLevel = Math.floor(map.getView().getZoom());

    map.getLayers().forEach(function(layer) {
        if (layer.get('name') && (layer.get('name').startsWith('buildings_z') || layer.get('name').startsWith('important_buildings'))) {
            const selectedLayerForZoom = userBuildingChoices[zoomLevel]; // Choix utilisateur pour ce niveau de zoom
            if (layer.get('name') === selectedLayerForZoom) {
                layer.setVisible(true); // Affiche la couche choisie
            } else {
                layer.setVisible(false); // Cache les autres couches
            }
        }
    });
}

// Gestion des choix utilisateurs via les menus déroulants
document.querySelectorAll('.batimentSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); 
        const selectedBat = event.target.value; 

        // Stocke le choix utilisateur
        userBuildingChoices[zoomLevel] = selectedBat;

        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedBat}`);

        // Mettre à jour la visibilité des couches
        updateLayerVisibilitybat();
    });
});

// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibilitybat();
});


// VOIES FERREES
var railwayLayers = [
    { name: 'VF_1', zIndex: 8 },
    { name: 'VF_2', zIndex: 8 },
    { name: 'VF_3', zIndex: 8 },
    { name: 'VF_4', zIndex: 8 },
    { name: 'VF_5', zIndex: 8 },
    { name: 'VF_6', zIndex: 8 },
    { name: 'VF_7', zIndex: 8 },
    { name: 'VF_8', zIndex: 8 },
    { name: 'VF_9', zIndex: 8 },
];

// Stocke les choix des utilisateurs pour chaque niveau de zoom
var userRailwayChoices = {}; 


// Ajoute toutes les couches railway à la carte
railwayLayers.forEach(railwayLayer => {
    var layer = createLayer(railwayLayer.name, railwayLayer.zIndex);
    map.addLayer(layer);
});

document.querySelectorAll('.voiesSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); 
        const selectedRail = event.target.value; 

        // Stocke le choix utilisateur
        userRailwayChoices[zoomLevel] = selectedRail;

        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedRail}`);

        // Mettre à jour la visibilité des couches
        updateLayerVisibility(userRailwayChoices,'VF_');
    });
});

// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibility(userRailwayChoices,'VF_');
});

// HYDRO
var hydro = [
    { name: 'hydro_10', zIndex: 2 },
    { name: 'hydro_11', zIndex: 2 },
    { name: 'hydro_12', zIndex: 2 },
    { name: 'hydro_13', zIndex: 1 },
    { name: 'hydro_14', zIndex: 1 },
    { name: 'hydro_15', zIndex: 1 },
    { name: 'hydro_16', zIndex: 1 },
    { name: 'hydro_17', zIndex: 1 },
];

// Stocke les choix des utilisateurs pour chaque niveau de zoom
var userHydroChoices = {};

// Ajoute toutes les couches de hydro à la carte au début
hydro.forEach(hydro => {
    var layer = createLayer(hydro.name, hydro.zIndex);
    map.addLayer(layer);
});

document.querySelectorAll('.hydroSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); 
        const selectedHydro = event.target.value; 

        // Stocke le choix utilisateur
        userHydroChoices[zoomLevel] = selectedHydro;
        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedHydro}`);
        updateLayerVisibility(userHydroChoices, 'hydro_');
    });
});

// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibility(userHydroChoices, 'hydro_');
});

// SURFACE HYDRO
var hydro_surf = [
    { name: 'hydro_surf10', zIndex: 1 },
    { name: 'hydro_surf11temp', zIndex: 1 },
    { name: 'hydro_surf12', zIndex: 1 },
    { name: 'hydro_surf13', zIndex: 1 },
    { name: 'hydro_surf14', zIndex: 1 },
    { name: 'hydro_surf15', zIndex: 1 }
];
var userHydroSurfChoices = {}; 
// Ajoute toutes les couches hydro_surf à la carte
hydro_surf.forEach(hydro_surf => {
    var layer = createLayer(hydro_surf.name, hydro_surf.zIndex);
    map.addLayer(layer);
});

document.querySelectorAll('.SurfHydroSelect').forEach(select => {
    select.addEventListener('change', event => {
        const zoomLevel = parseInt(select.dataset.zoom, 10); 
        const selectedHydroSurf = event.target.value; 

        // Stocke le choix utilisateur
        userHydroSurfChoices[zoomLevel] = selectedHydroSurf;
        console.log(`Niveau de zoom ${zoomLevel} : couche sélectionnée = ${selectedHydroSurf}`);
        updateLayerVisibility(userHydroSurfChoices, 'hydro_surf');
    });
});
// Mise à jour de la visibilité lors du changement de zoom
map.getView().on('change:resolution', function() {
    updateLayerVisibility(userHydroSurfChoices, 'hydro_surf');
});


// GESTION MENU 
document.addEventListener("DOMContentLoaded", () => {
    const bottomBar = document.getElementById("bottomBar");
    const toggleButton = document.getElementById("toggleButton");
    toggleButton.addEventListener("click", () => {
        if (bottomBar.classList.contains("collapsed")) {
          bottomBar.classList.remove("collapsed");
          toggleButton.textContent = "Réduire";
        } else {
          bottomBar.classList.add("collapsed");
          toggleButton.textContent = "Agrandir";
        }
      });
  });

function toggleColumnVisibility(checkboxId, columnClass) {
    const checkbox = document.getElementById(checkboxId);
    const columns = document.querySelectorAll(`.${columnClass}`);

    columns.forEach(column => {
        if (checkbox.checked) {
            column.style.display = 'block'; 
        } else {
            column.style.display = 'none'; 
        }
    });
}

document.getElementById('checkboxVille').addEventListener('change', () => {
    toggleColumnVisibility('checkboxVille', 'columnVille');
});

document.getElementById('checkboxRiver').addEventListener('change', () => {
    toggleColumnVisibility('checkboxRiver', 'columnRiver');
});

document.getElementById('checkboxVoies').addEventListener('change', () => {
    toggleColumnVisibility('checkboxVoies', 'columnVoies');
});

document.addEventListener("DOMContentLoaded", () => {
    const checkboxes = document.querySelectorAll('.flex-checkboxes input[type="checkbox"]');

function disableAllDisplays() {
    toggleColumnVisibility('checkboxVille', 'columnVille', false);
    toggleColumnVisibility('checkboxRiver', 'columnRiver', false);
    toggleColumnVisibility('checkboxVoies', 'columnVoies', false);
}

// Fonction pour gérer le comportement des checkboxes
checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            // Désactiver toutes les autres checkboxes et leurs affichages
            checkboxes.forEach((otherCheckbox) => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });

            disableAllDisplays();
            const checkboxId = checkbox.id;
            switch (checkboxId) {
                case 'checkboxVille':
                    toggleColumnVisibility('checkboxVille', 'columnVille', true);
                    break;
                case 'checkboxRiver':
                    toggleColumnVisibility('checkboxRiver', 'columnRiver', true);
                    break;
                case 'checkboxVoies':
                    toggleColumnVisibility('checkboxVoies', 'columnVoies', true);
                    break;
            }
        } else {
            // Si la case est décochée, désactiver son affichage
            disableAllDisplays();
        }
        });
    });
});

function toggleColumnVisibility(checkboxId, columnClass, force = null) {
    const checkbox = document.getElementById(checkboxId);
    const columns = document.querySelectorAll(`.${columnClass}`);
    const shouldShow = force !== null ? force : checkbox.checked;

    columns.forEach(column => {
        column.style.display = shouldShow ? 'block' : 'none';
    });
}

// **************A AJOUTER SUR LE CODE DE LAURE*********************

document.addEventListener("DOMContentLoaded", () => {
    // Récupérer les boutons et les modales
    const infoButton = document.getElementById("infoButton");
    const helpButton = document.getElementById("infoButton2");
    const modal1 = document.getElementById("modal1");
    const modal2 = document.getElementById("modal2");

    // Boutons de fermeture pour chaque modale
    const close1 = modal1.querySelector(".close");
    const close2 = modal2.querySelector(".close");

    // Ouvrir automatiquement la modale 1 lors du chargement de la page
    modal1.style.display = "block";

    // Ouvrir la modale 1 (Objectifs de l'expérience)
    infoButton.addEventListener("click", () => {
        modal1.style.display = "block";
    });

    // Fermer la modale 1
    close1.addEventListener("click", () => {
        modal1.style.display = "none";
    });

    // Ouvrir la modale 2 (Besoin d'aide)
    helpButton.addEventListener("click", () => {
        modal2.style.display = "block";
    });

    // Fermer la modale 2
    close2.addEventListener("click", () => {
        modal2.style.display = "none";
    });

    // Fermer les modales si on clique en dehors
    window.addEventListener("click", (event) => {
        if (event.target === modal1) {
            modal1.style.display = "none";
        }
        if (event.target === modal2) {
            modal2.style.display = "none";
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const highlights = document.querySelectorAll(".highlight");
    const highlightRectangle = document.getElementById("highlightRectangle");

    // Positions manuelles des éléments à surligner
    const positions = {
        zoom: {
            top: 5, // position verticale du bouton zoom
            right: 5, // position horizontale du bouton zoom
            width: 100, // largeur du bouton zoom (ajustez selon la taille réelle du bouton)
            height: 30, // hauteur du bouton zoom (ajustez selon la taille réelle du bouton)
        },
        couches: {
            top: 500, // position verticale de l'élément couches
            right: 5, // position horizontale de l'élément couches
            width: 150, // largeur de l'élément couches
            height: 120, // hauteur de l'élément couches
        },
        exploration: {
            top: 530, // position verticale de l'élément exploration
            right: 300, // position horizontale de l'élément exploration
            width: 1200, // largeur de l'élément exploration
            height: 30, // hauteur de l'élément exploration
        },

        deroulant: {
            top: 560, // position verticale de l'élément exploration
            right: 305,// position horizontale de l'élément exploration
            width: 1220, // largeur de l'élément exploration
            height: 120, // hauteur de l'élément exploration
        },
        fin: {
            top: 625, // position verticale de l'élément exploration
            right: 90,// position horizontale de l'élément exploration
            width: 65, // largeur de l'élément exploration
            height: 60, // hauteur de l'élément exploration
        },
    };

    highlights.forEach(function (highlight) {
        highlight.addEventListener("click", function (event) {
            const rectType = event.target.getAttribute("data-rect");
            
            // Récupérer la position à partir de l'objet 'positions'
            const position = positions[rectType];
            if (position) {
                // Positionner le rectangle à l'emplacement défini
                highlightRectangle.style.left = `calc(100% - ${position.right + position.width}px)`; // Calculer la position relative
                highlightRectangle.style.top = `${position.top}px`;
                highlightRectangle.style.width = `${position.width}px`;
                highlightRectangle.style.height = `${position.height}px`;

                // Afficher le rectangle
                highlightRectangle.style.display = "block";
            }
        });
    });

    // Optionnel : Cacher le rectangle si un clic ailleurs se produit (si vous le souhaitez)
    document.addEventListener("click", function (event) {
        if (!event.target.classList.contains("highlight")) {
            highlightRectangle.style.display = "none";
        }
    });
});







// ************FIN DE CE QU'IL FAUT RAJOUTER !!!******************