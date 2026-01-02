add_action('admin_footer-nav-menus.php', function() {
    ?>
    <script>
    jQuery(document).ready(function($){
        var $form = $('form#update-nav-menu');
        if($form.length){
            var html = '<p>';
            html += '<label for="import-subpages-input">Oberpunkte (kommagetrennt): </label>';
            html += '<input type="text" id="import-subpages-input" placeholder="iPhone, Samsung, Tablet" style="margin-right:10px;">';
            html += '<a href="#" id="import-subpages-btn" class="button button-primary">Bestehende Unterseiten ins Menü einfügen</a>';
            html += '</p>';
            $form.prepend(html);

            $('#import-subpages-btn').on('click', function(e){
                e.preventDefault();
                var parents = $('#import-subpages-input').val();

                if(parents.trim() === ''){
                    alert('Bitte mindestens einen Oberpunkt eingeben.');
                    return;
                }

                $.post(ajaxurl, {
                    'action': 'import_subpages_menu',
                    'security': '<?php echo wp_create_nonce("import_subpages_nonce"); ?>',
                    'parents': parents
                }, function(response){
                    if(response.success){
                        alert(response.data);
                        location.reload();
                    } else {
                        alert('Fehler: ' + response.data);
                    }
                });
            });
        }
    });
    </script>
    <?php
});

add_action('wp_ajax_import_subpages_menu', function(){
    check_ajax_referer('import_subpages_nonce', 'security');

    if(!isset($_POST['parents']) || empty($_POST['parents'])){
        wp_send_json_error('Keine Oberpunkte übermittelt.');
    }

    $parents = array_map('trim', explode(',', sanitize_text_field($_POST['parents'])));

    $menu_name = 'Main Menu';
    $menu = wp_get_nav_menu_object($menu_name);
    if(!$menu) wp_send_json_error('Menü nicht gefunden.');

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $added = 0;

    foreach($parents as $parent_title){
        $parent_item = null;
        foreach($menu_items as $item){
            if($item->title == $parent_title){
                $parent_item = $item;
                break;
            }
        }
        if(!$parent_item) continue;

        $children = get_pages(array('child_of' => $parent_item->object_id, 'sort_column' => 'menu_order'));

        foreach($children as $child){
            $exists = false;
            foreach($menu_items as $existing){
                if($existing->object_id == $child->ID){
                    $exists = true;
                    break;
                }
            }
            if($exists) continue;

            wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' => $child->post_title,
                'menu-item-object' => 'page',
                'menu-item-object-id' => $child->ID,
                'menu-item-type' => 'post_type',
                'menu-item-parent-id' => $parent_item->ID,
                'menu-item-status' => 'publish'
            ));
            $added++;
        }
    }

    wp_send_json_success("$added Unterseiten wurden ins Menü eingefügt.");
});
