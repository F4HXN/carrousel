/**
 * Carrousel Sites Pro - Admin JavaScript
 * Gestion du Media Uploader WordPress
 */

jQuery(document).ready(function($) {
    'use strict';
    
    // Variable pour stocker le media uploader
    let mediaUploader;
    let currentButton;
    
    // Fonction pour ouvrir le media uploader
    function openMediaUploader(button) {
        currentButton = button;
        
        // Si le media uploader existe déjà, l'ouvrir
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        
        // Créer le media uploader
        mediaUploader = wp.media({
            title: 'Choisir une image pour le site',
            button: {
                text: 'Utiliser cette image'
            },
            multiple: false,
            library: {
                type: 'image'
            }
        });
        
        // Quand une image est sélectionnée
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            const container = $(currentButton).closest('.image-upload-container');
            
            // Mettre à jour le champ caché avec l'URL de l'image
            container.find('.site-image-url').val(attachment.url);
            
            // Afficher la prévisualisation
            container.find('.image-preview').html(
                '<img src="' + attachment.url + '" style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 10px;">'
            );
            
            // Afficher le bouton supprimer
            container.find('.remove-image-btn').show();
        });
        
        // Ouvrir le media uploader
        mediaUploader.open();
    }
    
    // Événement pour ouvrir le media uploader
    $(document).on('click', '.upload-image-btn', function(e) {
        e.preventDefault();
        openMediaUploader(this);
    });
    
    // Événement pour supprimer l'image
    $(document).on('click', '.remove-image-btn', function(e) {
        e.preventDefault();
        const container = $(this).closest('.image-upload-container');
        
        // Vider le champ
        container.find('.site-image-url').val('');
        
        // Supprimer la prévisualisation
        container.find('.image-preview').html('');
        
        // Cacher le bouton supprimer
        $(this).hide();
    });
});
