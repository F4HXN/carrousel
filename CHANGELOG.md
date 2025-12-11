# Changelog - Carrousel Sites Pro

Toutes les modifications notables de ce projet seront documentées dans ce fichier.

---

## Version 1.6.1 (04 Décembre 2025)

### 🔧 Correction
* **Ombres renforcées** - Intensité des ombres augmentée pour une meilleure visibilité
* Ombre titre : `text-shadow: 3px 3px 8px rgba(0,0,0,0.4)` (opacité 20% → 40%)
* Ombre carrousel : `box-shadow: 0 10px 40px rgba(0,0,0,0.25)` (opacité 10% → 25%)
* Rayon de flou augmenté pour un effet plus marqué
* Effet de profondeur prononcé et bien visible

---

## Version 1.6.0 (04 Décembre 2025)

### ✨ Nouveautés
* **Ombres activables/désactivables** - Contrôle des effets d'ombre
* ☑️ Case à cocher pour activer/désactiver l'ombre sur le titre
* ☑️ Case à cocher pour activer/désactiver l'ombre sur le carrousel
* Options sauvegardées dans WordPress (csp_title_shadow, csp_carousel_shadow)
* Ombre carrousel activée par défaut

### 🎨 Design
* Choix entre design plat ou avec profondeur
* Styles prédéfinis : minimaliste, moderne, relief complet
* Application dynamique via CSS inline

---

## Version 1.5.0 (04 Décembre 2025)

### 🌈 Nouveautés majeures
* **Couleurs personnalisables** - Personnalisation complète des couleurs
* 🎨 Sélecteur de couleur pour le fond du carrousel
* 🎨 Sélecteur de couleur pour le titre
* Interface visuelle intuitive avec `<input type="color">`
* Prévisualisation du code couleur hex en temps réel
* Synchronisation automatique sélecteur ↔ champ texte

### ⚙️ Options ajoutées
* `csp_carousel_bg_color` - Couleur de fond (défaut: #ffffff)
* `csp_carousel_title_color` - Couleur du titre (défaut: #0076a5)
* Sauvegarde sécurisée avec `sanitize_hex_color()`
* CSS inline généré dynamiquement avec !important

---

## Version 1.4.1 (04 Décembre 2025)

### 🔧 Correction majeure
* **Suppression barre bleue** - Élimination complète des bordures indésirables
* Règles CSS renforcées avec `!important` sur tous les éléments
* Suppression forcée de tous les pseudo-éléments (::after, ::before)
* Compatible avec tous les thèmes WordPress
* Règles appliquées sur : wrapper, container, h2, carousel

### 📝 Modifications CSS
* `border: none !important` sur tous les niveaux
* `text-decoration: none !important` sur le titre
* `box-shadow: none !important` sur les éléments sans ombre
* Protection contre les styles des thèmes

---

## Version 1.4.0 (04 Décembre 2025)

### 🎯 Nouveautés
* **Titre personnalisable** - Configuration du titre dans l'interface admin
* Nouveau champ "Titre du carrousel" dans "Paramètres généraux"
* Titre configurable en un seul endroit
* S'applique automatiquement à tous les carrousels
* Surcharge possible via attribut shortcode `title="..."`

### ⚙️ Fonctionnement
* Option WordPress : `csp_carousel_title`
* Valeur par défaut : "Mes Sites Web"
* Priorité : attribut shortcode > config admin > défaut

---

## Version 1.3.0 (04 Décembre 2025)

### 🖼️ Fonctionnalité majeure
* **Upload d'images** - Intégration de la médiathèque WordPress
* 📷 Bouton "Choisir une image" pour chaque site
* Prévisualisation en temps réel (200px)
* Bouton "Supprimer l'image"
* Fallback automatique sur émojis si pas d'image

### 🎨 Affichage
* Images avec `object-fit: cover`
* Effet zoom au survol (scale 1.05)
* Recommandations : 1200×500px, <300KB, JPG/PNG
* Champ optionnel - pas d'obligation d'image

### 🔧 Technique
* `wp_enqueue_media()` - Chargement médiathèque WordPress
* `admin.js` - Gestion upload/suppression
* Sauvegarde URL image avec `esc_url_raw()`
* Rendu conditionnel : `<img>` si image, sinon emoji

---

## Version 1.2.0 (04 Décembre 2025)

### 🔧 Corrections importantes
* **Fix ajout de sites** - Résolution bug sauvegarde
* Réécriture du code de sauvegarde avec boucle `for()`
* Validation avec `isset()` pour chaque champ
* Sites exemple par défaut changés : exemple1.fr, exemple2.fr (au lieu de sites réels)

### ✨ Améliorations
* 🔄 Bouton "Réinitialiser aux valeurs par défaut"
* Scroll automatique vers le nouveau site ajouté
* Confirmations intelligentes avant suppression
* Alerte si modifications non enregistrées
* Messages de confirmation améliorés

---

## Version 1.1.0 (04 Décembre 2025)

### 🎯 Amélioration UX
* **Instruction cliquable** - Bouton "👆 Cliquez pour visiter" interactif
* Bouton entièrement cliquable (pas juste décoratif)
* Effets visuels au survol :
  - Changement de couleur (blanc → bleu #0076a5)
  - Texte change (blanc)
  - Animation scale (1.05)
  - Box-shadow renforcée
* Animation pulse pour attirer l'attention

---

## Version 1.0.0 (04 Décembre 2025)

### 🎉 Version initiale
* ✅ **Carrousel interactif** - Défilement automatique et manuel
* ✅ **Interface d'administration** - Gestion facile des sites
* ✅ **Shortcode avec options** - `[carrousel_sites]` personnalisable
* ✅ **Responsive design** - Adapté mobile, tablette, desktop
* ✅ **Accessibilité optimisée** - ARIA labels, navigation clavier

### 🌐 Fonctionnalités principales
* Ajout/suppression de sites illimités
* URL, titre, icône emoji, description pour chaque site
* Navigation : boutons prev/next, indicateurs, clavier, touch
* Auto-play configurable avec pause au survol
* Shortcode : `[carrousel_sites autoplay="true" delay="5000"]`

### 🎨 Design
* Couleurs : #0076a5 (bleu principal), #298ad4 (bleu clair)
* Fond blanc par défaut
* Animations fluides (transitions CSS)
* Overlay avec gradient sur les sites
* Responsive breakpoints : 768px, 480px

### 🔧 Technique
* Aucune dépendance externe
* JavaScript vanilla (pas de jQuery frontend)
* Compatible WordPress 5.0+
* Compatible PHP 7.0+
* Licence GPL v2

---

## 📝 Notes de version

### Compatibilité
* WordPress 5.0+
* PHP 7.0+
* Tous navigateurs modernes
* Mobile, tablette, desktop

### Installation
1. Télécharger `carrousel-sites-pro.zip`
2. WordPress → Extensions → Ajouter → Téléverser
3. Activer le plugin
4. Menu → Carrousel Sites → Configurer

### Support
* Site web : https://www.f4hxn.fr
* Auteur : Jean-Paul Mansouri (F4HXN)
* Licence : GPL v2

---

**Développé avec ❤️ par F4HXN**
