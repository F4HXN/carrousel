
<div class="wrap">
    <h1>
        <span class="dashicons dashicons-images-alt2" style="color: #0076a5;"></span>
        Carrousel Sites Pro
    </h1>
    
    <div style="background: white; padding: 20px; margin: 20px 0; border-left: 4px solid #0076a5;">
        <h2>📋 Utilisation</h2>
        <p>Pour afficher le carrousel sur votre site, utilisez le shortcode suivant :</p>
        <code style="background: #f5f5f5; padding: 10px 15px; display: inline-block; font-size: 14px; border-radius: 4px;">[carrousel_sites]</code>
        
        <h3 style="margin-top: 20px;">Options disponibles :</h3>
        <ul style="list-style: disc; margin-left: 30px;">
            <li><code>title</code> - Titre du carrousel (par défaut : "Mes Sites Web")</li>
            <li><code>autoplay</code> - Défilement automatique : true/false (par défaut : true)</li>
            <li><code>delay</code> - Délai entre les slides en millisecondes (par défaut : 5000)</li>
        </ul>
        
        <p><strong>Exemples :</strong></p>
        <code style="background: #f5f5f5; padding: 5px 10px; display: block; margin: 5px 0;">[carrousel_sites title="Découvrez mes projets"]</code>
        <code style="background: #f5f5f5; padding: 5px 10px; display: block; margin: 5px 0;">[carrousel_sites autoplay="false"]</code>
        <code style="background: #f5f5f5; padding: 5px 10px; display: block; margin: 5px 0;">[carrousel_sites delay="3000"]</code>
    </div>

    <form method="post" action="">
        <?php wp_nonce_field('csp_save_sites_action'); ?>
        
        <div style="background: white; padding: 20px; margin: 20px 0;">
            <h2>⚙️ Paramètres généraux</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="carousel_title">Titre du carrousel</label>
                    </th>
                    <td>
                        <input type="text" 
                               id="carousel_title"
                               name="carousel_title" 
                               value="<?php echo esc_attr(get_option('csp_carousel_title', 'Mes Sites Web')); ?>" 
                               class="regular-text"
                               placeholder="Mes Sites Web">
                        <p class="description">
                            Ce titre s'affichera au-dessus du carrousel.<br>
                            Vous pouvez aussi le modifier via le shortcode : <code>[carrousel_sites title="Votre titre"]</code>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="carousel_bg_color">Couleur de fond</label>
                    </th>
                    <td>
                        <input type="color" 
                               id="carousel_bg_color"
                               name="carousel_bg_color" 
                               value="<?php echo esc_attr(get_option('csp_carousel_bg_color', '#ffffff')); ?>" 
                               style="width: 100px; height: 40px; cursor: pointer;">
                        <input type="text" 
                               id="carousel_bg_color_text"
                               value="<?php echo esc_attr(get_option('csp_carousel_bg_color', '#ffffff')); ?>" 
                               class="regular-text"
                               readonly
                               style="margin-left: 10px; width: 100px;">
                        <p class="description">
                            Couleur de fond du carrousel (défaut : blanc #ffffff)
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="carousel_title_color">Couleur du titre</label>
                    </th>
                    <td>
                        <input type="color" 
                               id="carousel_title_color"
                               name="carousel_title_color" 
                               value="<?php echo esc_attr(get_option('csp_carousel_title_color', '#0076a5')); ?>" 
                               style="width: 100px; height: 40px; cursor: pointer;">
                        <input type="text" 
                               id="carousel_title_color_text"
                               value="<?php echo esc_attr(get_option('csp_carousel_title_color', '#0076a5')); ?>" 
                               class="regular-text"
                               readonly
                               style="margin-left: 10px; width: 100px;">
                        <p class="description">
                            Couleur du texte du titre (défaut : bleu #0076a5)
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="title_shadow">Ombre sur le titre</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   id="title_shadow"
                                   name="title_shadow" 
                                   value="1"
                                   <?php checked(get_option('csp_title_shadow', '0'), '1'); ?>>
                            Activer l'ombre portée sur le titre
                        </label>
                        <p class="description">
                            Ajoute une ombre légère au titre pour le faire ressortir
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="carousel_shadow">Ombre sur le carrousel</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" 
                                   id="carousel_shadow"
                                   name="carousel_shadow" 
                                   value="1"
                                   <?php checked(get_option('csp_carousel_shadow', '1'), '1'); ?>>
                            Activer l'ombre portée sur le carrousel
                        </label>
                        <p class="description">
                            Ajoute une ombre autour du carrousel pour un effet de profondeur (activé par défaut)
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div style="background: white; padding: 20px; margin: 20px 0;">
            <h2>🌐 Gérer vos sites</h2>
            <p>Ajoutez ou modifiez les sites affichés dans le carrousel.</p>
            
            <div id="sites-container">
                <?php foreach ($sites as $index => $site) : ?>
                    <div class="site-item" style="background: #f9f9f9; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #0076a5;">
                        <h3 style="margin-top: 0; color: #0076a5;">Site <?php echo $index + 1; ?>
                            <button type="button" class="button remove-site" style="float: right; background: #dc3232; color: white; border: none;">Supprimer</button>
                        </h3>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row"><label>URL du site <span style="color: red;">*</span></label></th>
                                <td>
                                    <input type="url" 
                                           name="site_url[]" 
                                           value="<?php echo esc_attr($site['url']); ?>" 
                                           class="regular-text" 
                                           required
                                           placeholder="https://www.exemple.fr">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label>Titre <span style="color: red;">*</span></label></th>
                                <td>
                                    <input type="text" 
                                           name="site_title[]" 
                                           value="<?php echo esc_attr($site['title']); ?>" 
                                           class="regular-text" 
                                           required
                                           placeholder="Mon site web">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label>Image (optionnel)</label></th>
                                <td>
                                    <div class="image-upload-container">
                                        <input type="hidden" 
                                               name="site_image[]" 
                                               class="site-image-url"
                                               value="<?php echo esc_attr(!empty($site['image']) ? $site['image'] : ''); ?>">
                                        
                                        <button type="button" class="button button-secondary upload-image-btn">
                                            <span class="dashicons dashicons-format-image"></span> Choisir une image
                                        </button>
                                        
                                        <button type="button" class="button button-secondary remove-image-btn" 
                                                style="<?php echo empty($site['image']) ? 'display:none;' : ''; ?>">
                                            <span class="dashicons dashicons-no"></span> Supprimer l'image
                                        </button>
                                        
                                        <div class="image-preview">
                                            <?php if (!empty($site['image'])) : ?>
                                                <img src="<?php echo esc_url($site['image']); ?>" 
                                                     style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 10px;">
                                            <?php endif; ?>
                                        </div>
                                        
                                        <p class="description">
                                            Image recommandée : 1200x500px (ratio 2.4:1)<br>
                                            Si aucune image n'est sélectionnée, l'icône emoji sera utilisée.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label>Icône (emoji)</label></th>
                                <td>
                                    <input type="text" 
                                           name="site_icon[]" 
                                           value="<?php echo esc_attr($site['icon']); ?>" 
                                           class="small-text" 
                                           placeholder="🌐">
                                    <p class="description">Exemples : 🌐 💻 📱 🎨 📊 🛒 📧 📻 🎵 📷 (utilisé si pas d'image)</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label>Description</label></th>
                                <td>
                                    <input type="text" 
                                           name="site_description[]" 
                                           value="<?php echo esc_attr($site['description']); ?>" 
                                           class="regular-text"
                                           placeholder="Courte description du site">
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="button" id="add-site" class="button button-secondary" style="margin-top: 15px;">
                <span class="dashicons dashicons-plus-alt"></span> Ajouter un site
            </button>
        </div>
        
        <p class="submit">
            <button type="submit" name="csp_save_sites" class="button button-primary button-large" style="background: #0076a5; border-color: #0076a5;">
                <span class="dashicons dashicons-saved" style="vertical-align: middle;"></span>
                Enregistrer les modifications
            </button>
        </p>
    </form>
    
    <form method="post" action="" style="margin-top: 20px;">
        <?php wp_nonce_field('csp_reset_sites_action'); ?>
        <div style="background: #fff3cd; padding: 20px; border-left: 4px solid #ffc107; border-radius: 4px;">
            <h3 style="margin-top: 0;">🔄 Réinitialiser aux sites exemple</h3>
            <p>Cette action supprimera tous vos sites actuels et les remplacera par deux sites exemple.</p>
            <button type="submit" name="csp_reset_sites" class="button button-secondary" 
                    onclick="return confirm('⚠️ Attention ! Cette action supprimera tous vos sites actuels et les remplacera par les sites exemple. Continuer ?');">
                <span class="dashicons dashicons-update"></span> Réinitialiser aux exemples
            </button>
        </div>
    </form>
    
    <div style="background: #fff3cd; padding: 20px; margin: 20px 0; border-left: 4px solid #ffc107; border-radius: 4px;">
        <h3 style="margin-top: 0;">💡 Astuce</h3>
        <p>Pour de meilleurs résultats :</p>
        <ul style="list-style: disc; margin-left: 30px;">
            <li>Utilisez des émojis simples pour les icônes</li>
            <li>Gardez les titres courts et explicites</li>
            <li>Testez le carrousel sur mobile après l'enregistrement</li>
            <li>3 à 5 sites donnent le meilleur rendu visuel</li>
        </ul>
    </div>
    
    <div style="background: #e8f4f8; padding: 20px; margin: 20px 0; border-left: 4px solid #0076a5; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #0076a5;">ℹ️ À propos</h3>
        <p><strong>Carrousel Sites Pro v<?php echo CSP_VERSION; ?></strong></p>
        <p>Développé par <strong>Jean-Paul Mansouri (F4HXN)</strong></p>
        <p>🌐 <a href="https://www.f4hxn.fr" target="_blank">www.f4hxn.fr</a></p>
    </div>
</div>

<style>
    .site-item {
        transition: all 0.3s ease;
    }
    .site-item:hover {
        box-shadow: 0 4px 12px rgba(0, 118, 165, 0.15);
    }
    .remove-site:hover {
        background: #a00 !important;
    }
</style>

<script>
jQuery(document).ready(function($) {
    'use strict';
    
    // Synchroniser le sélecteur de couleur de fond avec le champ texte
    $('#carousel_bg_color').on('input', function() {
        $('#carousel_bg_color_text').val($(this).val());
    });
    
    // Synchroniser le sélecteur de couleur du titre avec le champ texte
    $('#carousel_title_color').on('input', function() {
        $('#carousel_title_color_text').val($(this).val());
    });
    
    let siteCount = <?php echo count($sites); ?>;
    
    // Ajouter un site
    $('#add-site').on('click', function() {
        siteCount++;
        const newSite = `
            <div class="site-item" style="background: #f9f9f9; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #0076a5; position: relative;">
                <h3 style="margin-top: 0; color: #0076a5;">Site ${siteCount}
                    <button type="button" class="button remove-site" style="float: right; background: #dc3232; color: white; border: none;">✕ Supprimer</button>
                </h3>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label>URL du site <span style="color: red;">*</span></label></th>
                        <td>
                            <input type="url" 
                                   name="site_url[]" 
                                   value="" 
                                   class="regular-text" 
                                   required
                                   placeholder="https://www.exemple.fr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Titre <span style="color: red;">*</span></label></th>
                        <td>
                            <input type="text" 
                                   name="site_title[]" 
                                   value="" 
                                   class="regular-text" 
                                   required
                                   placeholder="Mon site web">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Image (optionnel)</label></th>
                        <td>
                            <div class="image-upload-container">
                                <input type="hidden" 
                                       name="site_image[]" 
                                       class="site-image-url"
                                       value="">
                                
                                <button type="button" class="button button-secondary upload-image-btn">
                                    <span class="dashicons dashicons-format-image"></span> Choisir une image
                                </button>
                                
                                <button type="button" class="button button-secondary remove-image-btn" style="display:none;">
                                    <span class="dashicons dashicons-no"></span> Supprimer l'image
                                </button>
                                
                                <div class="image-preview"></div>
                                
                                <p class="description">
                                    Image recommandée : 1200x500px (ratio 2.4:1)<br>
                                    Si aucune image n'est sélectionnée, l'icône emoji sera utilisée.
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Icône (emoji)</label></th>
                        <td>
                            <input type="text" 
                                   name="site_icon[]" 
                                   value="🌐" 
                                   class="small-text" 
                                   placeholder="🌐">
                            <p class="description">Exemples : 🌐 💻 📱 🎨 📊 🛒 📧 📻 🎵 📷 (utilisé si pas d'image)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Description</label></th>
                        <td>
                            <input type="text" 
                                   name="site_description[]" 
                                   value="" 
                                   class="regular-text"
                                   placeholder="Courte description du site">
                        </td>
                    </tr>
                </table>
            </div>
        `;
        
        $('#sites-container').append(newSite);
        
        // Scroll vers le nouveau site
        $('html, body').animate({
            scrollTop: $('#sites-container .site-item:last').offset().top - 100
        }, 500);
    });
    
    // Supprimer un site
    $(document).on('click', '.remove-site', function() {
        const siteItem = $(this).closest('.site-item');
        const siteName = siteItem.find('input[name="site_title[]"]').val() || 'ce site';
        
        if (confirm('Êtes-vous sûr de vouloir supprimer "' + siteName + '" ?')) {
            siteItem.fadeOut(300, function() {
                $(this).remove();
                // Renumbéroter les sites
                $('#sites-container .site-item').each(function(index) {
                    $(this).find('h3').contents().first().replaceWith('Site ' + (index + 1) + ' ');
                });
            });
        }
    });
    
    // Confirmation avant de quitter avec des modifications non sauvegardées
    let formChanged = false;
    
    $('input[type="text"], input[type="url"]').on('change', function() {
        formChanged = true;
    });
    
    $('form').on('submit', function() {
        formChanged = false;
    });
    
    $(window).on('beforeunload', function() {
        if (formChanged) {
            return 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});
</script>
