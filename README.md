Projet d'étude : GRADUATE Developpeur Web / Web Mobile
URL site : https://project-kgb-missions.herokuapp.com/

Pour tester l'appli en tant qu'Admin, utilisez le compte suivant :
email : studi.project.john.doe@gmail.com
mpd : adminstudijd

Application réaliser avec le framework Symfony
Contexte projet : 
Les agents ont un nom, un prénom, une date de naissance, un code d'identification, une nationalité, 1 ou plusieurs spécialités.
* Les cibles ont un nom, un prénom, une date de naissance, un nom de code, une nationalité.
* Les contacts ont un nom, un prénom, une date de naissance, un nom de code, une nationalité.
* Les planques ont un code, une adresse, un pays, un type.
* Les missions ont un titre, une description, un nom de code, un pays, 1 ou plusieurs agents, 1 ou plusieurs contacts, 1 ou plusieurs cibles, un type de mission (Surveillance, Assassinat, Infiltration ...), un statut (En préparation, en cours, terminé, échec), 0 ou plusieurs planque, 1 spécialité requise, date de début, date de fin.
* Les administrateurs ont un nom, un prénom, une adresse mail, un mot de passe, une date de création. Règle métier :
* Sur une mission, la ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents.
* Sur une mission, les contacts sont obligatoirement de la nationalité du pays de la mission.
* Sur une mission, la planque est obligatoirement dans le même pays que la mission.
* Sur une mission, il faut assigner au moins 1 agent disposant de la spécialité requise.
