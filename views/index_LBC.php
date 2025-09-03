<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bonne Carte</title>
    <link rel="stylesheet" href="ressources/ol/ol.css">
    <link rel="stylesheet" href="ressources/ol-layerswitcher-master/dist/ol-layerswitcher.css">
    <link rel="stylesheet" href="assets/style_LBC.css">
</head>
<body>
    <div id="zoom"></div>

    <!-- Légende de la carte -->
    <div id="legend">
        <h3 class="legend-text">Légende</h3>
        <div class="legend-item">
            <span class="legend-line" style="background-color:#98AEC9;"></span>
            <span class="legend-text">Routes</span>
        </div>
        <div class="legend-item">
            <span class="legend-color" style="background-color:#B6EFCD;"></span>
            <span class="legend-text">Végétation</span>
        </div>
        <div class="legend-item">
            <span class="legend-point"></span>
            <span class="legend-text">Limites <br>départementales</span>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <button id="infoButton">Objectifs de l'expérience</button>
            <button id="infoButton2">Guide d'utilisation</button>
            <div id="map"></div>
        </div>

        <!-- Modal pour les objectifs de l'expérience -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>
                    Dans cette expérience, vous pourrez choisir à quel niveau de zoom vous voulez faire apparaître chaque donnée. Vous avez la possibilité de ne rien afficher, ou d’afficher la même représentation sur plusieurs niveaux de zoom, si cela vous semble être le mieux. Après chaque choix, vous verrez l’application cartographique s’adapter en temps réel pour afficher vos préférences et vous permettre de revenir sur vos choix si besoin.<br><br>

                    Vous pouvez modifier trois thèmes cartographiques : les cours d’eau, les voies ferrées ainsi que le bâti. Le reste s’affiche en fond de carte et n’est pas modifiable par défaut.<br><br>

                    N'hésitez pas à expérimenter en activant ou désactivant les couches et en ajustant les niveaux de zoom pour observer comment vos choix influencent l'affichage des éléments géographiques. Les niveaux de zoom disponibles vont de 9 à 16. Pour une prise en main optimale de l'application, n'hésitez pas à consulter le guide d'utilisation qui détaille son fonctionnement.
                </p>
            </div>
        </div>

        <!-- Modal pour le guide d'utilisation -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>
                    Cette aide vous guide à travers les principales fonctionnalités (cliquez sur les mots soulignés pour voir l'emplacement de l'information sur la page) : 
                    <br><br>
                    1. <span class="highlight" data-rect="zoom">Zoom</span> : Vous pouvez consulter ici le niveau de zoom actuel. <br>
                    2. <span class="highlight" data-rect="couches">Couches de données</span> : Sélectionnez les différentes couches de données à afficher. <br>
                    <br>
                    Après avoir sélectionné une couche : 
                    <br>
                    <br>3. <span class="highlight" data-rect="exploration">Niveau de zoom</span> : Chaque colonne représente un niveau de zoom spécifique.</br>
                    <br>4. <span class="highlight" data-rect="deroulant">Menu déroulant</span> : Sélectionnez la couche à afficher pour chaque niveau de zoom ici.</br>
                    <br> 5. <span class="highlight" data-rect="fin">Fin de l'expérience</span> : Une fois toutes vos couches sélectionnées, cliquez sur le bouton "Fin" pour enregistrer vos choix.</br>        
                </p>
            </div>
            <div id="highlightRectangle" class="highlight-rectangle"></div>
        </div>
    </div>

    <!-- Barre inférieure avec formulaire de sélection -->
    <div class="bottom-bar" id="bottomBar">
        <div class="bottom-bar-header">
            <button id="toggleButton">Réduire</button>
        </div>

        <form  action="/fin" method="post">

        <div class="flex-row">
            <div class="flex-column columnVille first-column">
                <div class="row-label">Bâtiment</div>
                <div class="row-label">Zone urbaine</div>
                <div class="row-label">Toponyme</div>
            </div>
            
            <div class="flex-column columnVille" >
                <div class="pixel"> en dessous de 10</div>
                <select class="batimentSelect" name="zoom_9[batiment]" data-zoom="9" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect"name="zoom_9[urban]" data-zoom="9" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect"  name="zoom_9[toponym]" data-zoom="9" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVille">
                <div class="pixel">zoom 10-11</div>
                <select class="batimentSelect" name="zoom_10[batiment]" data-zoom="10" data-type="batiment">
                    <option value="">Chosir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_10[urban]" data-zoom="10" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_10[toponym]" data-zoom="10" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVille">
                <div class="pixel">zoom 11-12</div>
                <select class="batimentSelect" name="zoom_11[batiment]" data-zoom="11" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_11[urban]" data-zoom="11" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_11[toponym]" data-zoom="11" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVille">
                <div class="pixel">zoom 12-13</div>
                <select class="batimentSelect" name="zoom_12[batiment]" data-zoom="12" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_12[urban]" data-zoom="12" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_12[toponym]" data-zoom="12" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVille">
                <div class="pixel">zoom 13-14</div>
                <select class="batimentSelect" name="zoom_13[batiment]" data-zoom="13" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_13[urban]" data-zoom="13" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_13[toponym]" data-zoom="13" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVille">
                <div class="pixel">zoom 14-15</div>
                <select class="batimentSelect" name="zoom_14[batiment]" data-zoom="14" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_14[urban]" data-zoom="14" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_14[toponym]" data-zoom="14" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVille">
                <div class="pixel">zoom 15-16</div>
                <select class="batimentSelect" name="zoom_15[batiment]" data-zoom="15" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" dname="zoom_15[urban]" data-zoom="15" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_15[toponym]" data-zoom="15" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVille">
                <div class="pixel">zoom 16</div>
                <select class="batimentSelect" name="zoom_16[batiment]" data-zoom="16" data-type="batiment">
                    <option value="">Choisir</option>
                    <option value="buildings_z17">A</option>
                    <option value="buildings_z18">B</option>
                    <option value="important_buildings">C</option>
                    <option value=""> Rien </option>
                </select>
                <select class="urbanSelect" name="zoom_16[urban]" data-zoom="16" data-type="urban">
                    <option value="">Choisir</option>
                    <option value="urban_area_zoom10">A</option>
                    <option value="urban_area_zoom11">B</option>
                    <option value="urban_area_zoom12">C</option>
                    <option value="urban_area_zoom13">D</option>
                    <option value="urban_area_zoom14">E</option>
                    <option value="urban_area_zoom15">F</option>
                    <option value=""> Rien </option>
                </select>
                <select class="toponymSelect" name="zoom_16[toponym]" data-zoom="16" data-type="toponym">
                    <option value="">Choisir</option>
                    <option value="points_zoom8">A</option>
                    <option value="points_zoom9">B</option>
                    <option value="points_zoom10">C</option>
                    <option value="points_zoom11">D</option>
                    <option value="points_zoom12">E</option>
                    <option value="points_zoom13">F</option>
                    <option value="points_zoom14">G</option>
                    <option value="points_zoom15">H</option>
                    <option value=""> Rien </option>
                </select>
            </div>      

            <!-- LES RIVIERES -->

            <div class="flex-column columnRiver first-column">
                <div class="row-label">Cours d'eau</div>
                <div class="row-label">Surface d'eau</div>
    
            </div>

            <div class="flex-column columnRiver" >
                <div class="pixel">en dessous de 10</div>
                <select class="hydroSelect" name="zoom_9[linear]" data-zoom="9" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_9[surface]" data-zoom="9" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column columnRiver">
                <div class="pixel">zoom 10-11</div>
                <select class="hydroSelect" name="zoom_10[linear]" data-zoom="10" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_10[surface]" data-zoom="10" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column  columnRiver">
                <div class="pixel">zoom 11-12</div>
                <select class="hydroSelect" name="zoom_11[linear]" data-zoom="11" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_11[surface]" data-zoom="11" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column  columnRiver">
                <div class="pixel">zoom 12-13</div>
                <select class="hydroSelect" name="zoom_12[linear]" data-zoom="12" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_12[surface]" data-zoom="12" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column  columnRiver">
                <div class="pixel">zoom 13-14</div>
                <select class="hydroSelect" name="zoom_13[linear]" data-zoom="13" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_13[surface]" data-zoom="13" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column columnRiver">
                <div class="pixel">zoom 14-15</div>
                <select class="hydroSelect" name="zoom_14[linear]" data-zoom="14" data-type="linear">
                    <option value="">Choisir</option>
                    <<option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_14[surface]" data-zoom="14" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column columnRiver">
                <div class="pixel">zoom 15-16</div>
                <select class="hydroSelect" name="zoom_15[linear]" data-zoom="15" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_15[surface]" data-zoom="15" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>
            <div class="flex-column columnRiver">
                <div class="pixel">zoom 16</div>
                <select class="hydroSelect" name="zoom_16[linear]" data-zoom="16" data-type="linear">
                    <option value="">Choisir</option>
                    <option value="hydro_10">A</option>
                    <option value="hydro_11">B</option>
                    <option value="hydro_12">C</option>
                    <option value="hydro_13">D</option>
                    <option value="hydro_14">E</option>
                    <option value="hydro_15">F</option>
                    <option value="hydro_16">G</option>
                    <option value="hydro_17">H</option>
                    <option>Rien</option>
                </select>
                <select class="SurfHydroSelect" name="zoom_16[surface]" data-zoom="16" data-type="surface">
                    <option value="">Choisir</option>
                    <option value="hydro_surf10">A</option>
                    <option value="hydro_surf11temp">B</option>
                    <option value="hydro_surf12">C</option>
                    <option value="hydro_surf13">D</option>
                    <option value="hydro_surf14">E</option>
                    <option value="hydro_surf15">F</option>
                    <option>Rien</option>
                </select>
            </div>

        
            <!-- LES VOIES FERREES -->

            <div class="flex-column columnVoies first-column">
                <div class="row-label">Voies ferrées</div>
                
    
            </div>
            <div class="flex-column columnVoies" >
                <div class="pixel">en dessous de 10</div>
                <select class="voiesSelect" name="zoom_9[railway]" data-zoom="9" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVoies">
                <div class="pixel">zoom 10-11</div>
                <select class="voiesSelect" name="zoom_10[railway]" data-zoom="10" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVoies">
                <div class="pixel">zoom 11-12</div>
                <select class="voiesSelect" name="zoom_11[railway]" data-zoom="11" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVoies">
                <div class="pixel">zoom 12-13</div>
                <select class="voiesSelect" name="zoom_12[railway]" data-zoom="12" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column  columnVoies">
                <div class="pixel">zoom 13-14</div>
                <select class="voiesSelect" name="zoom_13[railway]" data-zoom="13" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVoies">
                <div class="pixel">zoom 14-15</div>
                <select class="voiesSelect" name="zoom_14[railway]" data-zoom="14" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVoies">
                <div class="pixel">zoom 15-16</div>
                <select class="voiesSelect" name="zoom_15[railway]" data-zoom="15" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>
            <div class="flex-column columnVoies">
                <div class="pixel">zoom 16</div>
                <select class="voiesSelect" name="zoom_16[railway]" data-zoom="16" data-type="railway">
                    <option value="">Choisir</option>
                    <option value="VF_9">A </option>
                    <option value="VF_8">B</option>
                    <option value="VF_7">C</option>
                    <option value="VF_6">D</option>
                    <option value="VF_5">E</option>
                    <option value="VF_4">F</option>
                    <option value="VF_3">G</option>
                    <option value="VF_2">H</option>
                    <option value="VF_1">I</option>
                    <option> Rien </option>
                </select>
            </div>

            <div class="flex-checkboxes">
                <div>
                    <input type="checkbox" id="checkboxVille" class="single-checkbox">
                    <label for="checkboxVille">Villes</label>
                </div>
                <div>
                    <input type="checkbox" id="checkboxRiver" class="single-checkbox">
                    <label for="checkboxRiver">Rivières</label>
                </div>
                <div>
                    <input type="checkbox" id="checkboxVoies" class="single-checkbox">
                    <label for="checkboxVoies">Voies ferrées</label>
                </div>
            </div>
        </div>
        <div id="finishContainer">
        <button id="finishButton">Fin</button>
    </div>
</form>




    </div>
    <script src="/assets/main_LBC.js" defer></script>
    <script src="ressources/ol/ol.js"></script>
    <script src="ressources/ol-layerswitcher-master/dist/ol-layerswitcher.js"></script>
   
</body>
</html>