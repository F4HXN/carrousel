# Carrousel Sites Pro

**Version:** 1.0.0  
**Auteur:** Jean-Paul Mansouri (F4HXN)  
**Site web:** https://www.f4hxn.fr  
**Licence:** GPL v2 or later

## 📋 Description

Carrousel Sites Pro est un plugin WordPress élégant et professionnel qui permet d'afficher vos différents sites web dans un carrousel interactif avec prévisualisation et ouverture au clic.

## ✨ Fonctionnalités

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
2. Ajoutez ou modifiez vos sites :
   - **URL** : L'adresse complète du site (https://...)
   - **Titre** : Le nom à afficher
   - **Icône** : Un emoji représentatif (📻 💻 🌐 etc.)
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

### Couleurs du thème

Le plugin utilise les couleurs :
- **Primaire** : #0076a5
- **Secondaire** : #298ad4
- **Fond** : blanc

Pour personnaliser les couleurs, modifiez le fichier :
`/assets/css/carrousel-sites-pro.css`

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

### Version 1.0.0 (2024)
- 🎉 Version initiale
- ✅ Carrousel interactif
- ✅ Interface d'administration
- ✅ Shortcode avec options
- ✅ Responsive design
- ✅ Accessibilité optimisée

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

**© 2024 Jean-Paul Mansouri (F4HXN) - Tous droits réservés**
