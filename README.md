# Carrousel Sites Pro

**Version:** 1.6.1  
**Auteur:** Jean-Paul Mansouri (F4HXN)  
**Site web:** https://www.f4hxn.fr  
**Licence:** GPL v2 or later

## 📋 Description

Carrousel Sites Pro est un plugin WordPress élégant et professionnel qui permet d'afficher vos différents sites web dans un carrousel interactif avec prévisualisation et ouverture au clic.

## ✨ Fonctionnalités

- ✅ **Ombres personnalisables** - Activer/désactiver les ombres (v1.6.1)
- ✅ **Couleurs personnalisables** - Choix fond et titre (v1.5.0)
- ✅ **Titre personnalisable** - Configuration du titre (v1.4.0)
- ✅ **Upload d'images** - Intégration médiathèque WordPress (v1.3.0)
- ✅ **Carrousel interactif** avec navigation fluide
- ✅ **Défilement automatique** paramétrable
- ✅ **Navigation multiple** : boutons, indicateurs, clavier, tactile
- ✅ **Responsive** et optimisé mobile
- ✅ **Interface d'administration** intuitive
- ✅ **Shortcode simple** à utiliser
- ✅ **Personnalisation complète** des sites affichés
- ✅ **Accessibilité** optimisée (ARIA, navigation clavier)
- ✅ **Aucune dépendance** (pas de jQuery dans le frontend)

## 🚀 Installation

### Méthode 1 : Upload manuel

1. Téléchargez le dossier `carrousel-sites-pro`
2. Uploadez-le dans `/wp-content/plugins/`
3. Activez le plugin depuis le menu "Extensions" de WordPress

### Méthode 2 : Upload ZIP

1. Compressez le dossier `carrousel-sites-pro` en ZIP
2. Dans WordPress : Extensions > Ajouter > Téléverser une extension
3. Sélectionnez le fichier ZIP
4. Cliquez sur "Installer maintenant" puis "Activer"

## 📖 Utilisation

### Shortcode de base

```
[carrousel_sites]
```

### Shortcode avec options

```
[carrousel_sites title="Découvrez mes projets" autoplay="true" delay="5000"]
```

### Paramètres disponibles

| Paramètre | Type | Défaut | Description |
|-----------|------|--------|-------------|
| `title` | string | "Mes Sites Web" | Titre affiché au-dessus du carrousel |
| `autoplay` | boolean | true | Active/désactive le défilement automatique |
| `delay` | integer | 5000 | Délai en millisecondes entre chaque slide |

### Exemples d'utilisation

```
[carrousel_sites]
```

```
[carrousel_sites title="Mes Projets"]
```

```
[carrousel_sites autoplay="false"]
```

```
[carrousel_sites delay="3000"]
```

```
[carrousel_sites title="Portfolio" autoplay="true" delay="4000"]
```

## ⚙️ Configuration

1. Allez dans **Carrousel Sites** dans le menu WordPress

### Paramètres généraux

- **Titre du carrousel** : Personnalisez le titre affiché
- **Couleur de fond** : Sélecteur de couleur pour le fond (défaut: #ffffff)
- **Couleur du titre** : Sélecteur de couleur pour le titre (défaut: #0076a5)
- **☑️ Ombre sur le titre** : Activer pour effet relief sur le titre
- **☑️ Ombre sur le carrousel** : Activer pour effet profondeur (activé par défaut)

### Gérer vos sites

2. Ajoutez ou modifiez vos sites :
   - **URL** : L'adresse complète du site (https://...)
   - **Titre** : Le nom à afficher
   - **Image** : (optionnel) Cliquez sur 📷 Choisir une image - Médiathèque WordPress
     - Recommandé : 1200×500px, <300KB, JPG/PNG
   - **Icône** : Un emoji représentatif (utilisé si pas d'image)
   - **Description** : Une courte description (optionnel)
3. Cliquez sur "Enregistrer les modifications"

### Émojis recommandés pour les icônes

- 🌐 Site web général
- 💻 Site technique / développement
- 📱 Application mobile
- 🎨 Portfolio créatif
- 📊 Site d'analyse / statistiques
- 🛒 Site e-commerce
- 📧 Site de contact
- 📻 Radio / podcast
- 🎵 Site musical
- 📷 Photographie
- 🎓 Site éducatif
- 🏢 Site d'entreprise

## 🎨 Personnalisation

### Couleurs (v1.5.0+)

Le plugin offre des sélecteurs de couleur dans l'interface admin :

**Défaut** :
- **Fond** : #ffffff (blanc)
- **Titre** : #0076a5 (bleu)

**Personnalisation** :
1. Menu → Carrousel Sites → Paramètres généraux
2. Cliquez sur les sélecteurs de couleur
3. Choisissez vos couleurs
4. Enregistrez les modifications

**Exemples de styles** :
- **Moderne** : Fond #ffffff, Titre #0076a5
- **Élégant** : Fond #f5f5f5, Titre #333333
- **Sombre** : Fond #1a1a1a, Titre #ffffff
- **Coloré** : Fond #e3f2fd, Titre #1976d2

### Ombres (v1.6.0+)

**Ombre sur le titre** :
- Effet : `text-shadow: 3px 3px 8px rgba(0,0,0,0.4)`
- Usage : Faire ressortir le titre sur fonds colorés

**Ombre sur le carrousel** :
- Effet : `box-shadow: 0 10px 40px rgba(0,0,0,0.25)`
- Usage : Effet "carte flottante" avec profondeur

**Configuration** :
- Cochez/décochez les cases dans Paramètres généraux
- Activé par défaut : ombre carrousel
- Désactivé par défaut : ombre titre

### Images (v1.3.0+)

**Recommandations** :
- Dimensions : 1200×500px (ratio 2.4:1)
- Poids : 200-300 KB maximum
- Format : JPG (photos) ou PNG (logos)
- Upload via médiathèque WordPress

### Hauteur du carrousel

Par défaut : 500px sur desktop, 400px sur tablette, 300px sur mobile

Pour modifier, changez dans le CSS :
```css
.site-preview {
    height: 500px; /* Votre hauteur */
}
```

## 📱 Compatibilité

- ✅ WordPress 5.0+
- ✅ PHP 7.0+
- ✅ Tous les navigateurs modernes
- ✅ Responsive (mobile, tablette, desktop)
- ✅ Compatible avec tous les thèmes WordPress

## 🔧 Structure du plugin

```
carrousel-sites-pro/
│
├── carrousel-sites-pro.php    # Fichier principal du plugin
├── README.md                   # Ce fichier
│
├── assets/
│   ├── css/
│   │   └── carrousel-sites-pro.css    # Styles
│   └── js/
│       └── carrousel-sites-pro.js     # JavaScript
│
└── admin/
    └── admin-page.php          # Interface d'administration
```

## 🎯 Fonctionnalités détaillées

### Navigation

- **Boutons** : Précédent / Suivant
- **Indicateurs** : Clic direct sur un site
- **Clavier** : Flèches gauche/droite
- **Tactile** : Swipe gauche/droite sur mobile
- **Auto-play** : Défilement automatique avec pause au survol

### Accessibilité

- Labels ARIA pour les lecteurs d'écran
- Navigation clavier complète
- Focus visible sur les éléments interactifs
- Rôles ARIA appropriés

### Performance

- CSS et JS minifiés
- Pas de dépendances externes
- Chargement optimisé
- Code léger et performant

## 🆘 Support

Pour toute question ou problème :

- **Site web** : https://www.f4hxn.fr
- **Email** : contact via le site
- **GitHub** : Issues sur le repository

## 📝 Changelog

### Version 1.6.1 (04 Décembre 2025)
- 🔧 **Ombres renforcées** - Intensité augmentée pour meilleure visibilité
- Ombre titre : opacité 20% → 40%, flou 4px → 8px
- Ombre carrousel : opacité 10% → 25%, rayon 30px → 40px

### Version 1.6.0 (04 Décembre 2025)
- ✨ **Ombres personnalisables** - Cases à cocher pour activer/désactiver
- ☑️ Ombre sur le titre (désactivée par défaut)
- ☑️ Ombre sur le carrousel (activée par défaut)
- Choix entre design plat ou avec profondeur

### Version 1.5.0 (04 Décembre 2025)
- 🌈 **Couleurs personnalisables** - Sélecteurs de couleur visuels
- 🎨 Couleur de fond du carrousel
- 🎨 Couleur du titre
- Prévisualisation code hex en temps réel

### Version 1.4.1 (04 Décembre 2025)
- 🔧 **Suppression barre bleue** - Règles CSS renforcées
- Correction complète des bordures indésirables
- Compatible tous thèmes WordPress

### Version 1.4.0 (04 Décembre 2025)
- 🎯 **Titre personnalisable** - Configuration dans interface admin
- Champ "Titre du carrousel" dans Paramètres généraux
- Surcharge possible via shortcode

### Version 1.3.0 (04 Décembre 2025)
- 🖼️ **Upload d'images** - Intégration médiathèque WordPress
- Prévisualisation en temps réel
- Fallback automatique sur émojis

### Version 1.2.0 (04 Décembre 2025)
- 🔧 Fix ajout de sites
- 🔄 Bouton réinitialiser aux valeurs par défaut
- Sites exemple génériques

### Version 1.1.0 (04 Décembre 2025)
- 🎯 Instruction "Cliquez pour visiter" entièrement cliquable
- Effets visuels au survol améliorés

### Version 1.0.0 (04 Décembre 2025)
- 🎉 Version initiale
- ✅ Carrousel interactif
- ✅ Interface d'administration
- ✅ Shortcode avec options
- ✅ Responsive design
- ✅ Accessibilité optimisée

**Voir [CHANGELOG.md](CHANGELOG.md) pour l'historique détaillé**

## 📄 Licence

Ce plugin est distribué sous licence GPL v2 or later.

## 👤 Auteur

**Jean-Paul Mansouri (F4HXN)**

- Site web : https://www.f4hxn.fr
- Radio amateur : F4HXN
- Locator : JN33KW

## 🙏 Remerciements

Merci d'utiliser Carrousel Sites Pro !

Si vous appréciez ce plugin, n'hésitez pas à laisser un avis ou à le partager.

---

**© 2025 Jean-Paul Mansouri (F4HXN) - Tous droits réservés**
