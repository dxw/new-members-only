<?php

add_action('admin_menu', 'new_members_only_admin_menu');
add_filter('whitelist_options', 'new_members_only_whitelist_options');

function new_members_only_admin_menu() {
  add_options_page(__('New Members Only'), __('New Members Only'), 8, __FILE__, 'new_members_only_options_page');
}

function new_members_only_whitelist_options($whitelist_options) {
  $whitelist_options['new-members-only'] = array();
  $whitelist_options['new-members-only'][] = 'new_members_only_whitelist';
  $whitelist_options['new-members-only'][] = 'new_members_only_redirect_root';
  $whitelist_options['new-members-only'][] = 'new_members_only_redirect_elsewhere';
  $whitelist_options['new-members-only'][] = 'new_members_only_redirect_return';
  return $whitelist_options;
}

function new_members_only_options_page() {
?>
<div class="wrap">
  <h2><?php _e('New Members Only') ?></h2>

  <form method="post" action="options.php">
    <?php settings_fields('new-members-only') ?>

    <table class="form-table">

      <tr valign="top">
        <th scope="row"><label for="new_members_only_whitelist"><?php _e('Whitelist') ?></label></th>
        <td>
          <textarea cols="30" rows="5" name="new_members_only_whitelist" id="new_members_only_whitelist"><?php echo esc_html(get_option('new_members_only_whitelist')) ?></textarea>
          <br>
          <span class="description"><?php _e('One host-relative URI per line. No regular expression syntax supported, query string ignored.') ?></span>
        </td>
      </tr>

    </table>

    <h3><?php _e('Redirection') ?></h3>

    <table class="form-table">

      <tr valign="top">
        <th scope="row"><label for="new_members_only_redirect_root"><?php _e('Redirect visitors to / to') ?></label></th>
        <td><input type="text" name="new_members_only_redirect_root" id="new_members_only_redirect_root" value="<?php form_option('new_members_only_redirect_root') ?>"></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="new_members_only_redirect_elsewhere"><?php _e('Redirect visitors to elsewhere to') ?></label></th>
        <td><input type="text" name="new_members_only_redirect_elsewhere" id="new_members_only_redirect_elsewhere" value="<?php form_option('new_members_only_redirect_elsewhere') ?>"></td>
      </tr>

      <tr valign="top">
        <th scope="row"><?php _e('After login') ?></th>

        <td>
          <fieldset>
            <legend class="screen-reader-text"><span><?php _e('After login') ?></span></legend>

            <?php $o=get_option('new_members_only_redirect_return') ?>
            <label><input type="radio" name="new_members_only_redirect_return" value="return" <?php checked('return',$o) ?>> Redirect to original destination</label><br>
            <label><input type="radio" name="new_members_only_redirect_return" value="homepage" <?php checked('homepage',$o) ?>> Redirect to homepage</label>
          </fieldset>
        </td>
      </tr>

    </table>

    <?php submit_button() ?>
  </form>
</div>
<?php
}
