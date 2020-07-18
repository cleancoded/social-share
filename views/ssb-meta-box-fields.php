<!-- Hidden nonce field -->
<input type="hidden" value="<?php echo $nonce; ?>" name="CLEANCODED_nonce"/>
<table class="SocialShareFields">
    <!-- Show/Hide buttons from page field -->
    <tr class="form-field" valign="middle">
        <td scope="row"> <label for="SocialShareShowButtons"><?php _e('Show SSB Buttons on page', 'cleancoded-ssb'); ?></label></td>
        <td>
            <input type="checkbox" name="CLEANCODED_show_on_page" value="1" <?php echo ($CLEANCODED_show_on_page==1)?'checked="checked"' :''; ?> />
        </td>
    </tr>
    <tr valign="middle">
        <td colspan="2">&nbsp;</td>
    </tr>
    <!-- End Show/Hide buttons from page field -->

    <!-- SSB Image -->
    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="SocialShareUploadImage"><?php _e('Upload Image', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <input id="SocialShareUploadImage" type="text" name="CLEANCODED_image" value="<?php echo $CLEANCODED_image; ?>"/>
            <input id="upload_image_button" class="button-primary SocialShareSetCustomImages" type="button"
                   value="<?php _e('Select Image', 'cleancoded-ssb') ?>"/>
            </label>
        </td>
    </tr>
    <!-- End SSB Image-->

    <!-- Facebook section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('Facebook SSB', 'cleancoded-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="middle">
        <td scope="row">
            <label for="SocialShareFacebookTitle"><?php _e('Facebook Title', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <input id="SocialShareFacebookTitle" type="text" name="CLEANCODED_facebook_title"
                   value="<?php echo $CLEANCODED_facebook_title; ?>" maxlength="100"/>
            <small><i><?php _e('Facebook title length must be 100 symbols maximum.', 'cleancoded-ssb'); ?></i></small>
            <?php if (isset($CLEANCODED_facebook_title_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_facebook_title_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="SocialShareFacebookDescription"><?php _e('Facebook Description', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <textarea id="SocialShareFacebookDescription" name="CLEANCODED_facebook_description"
                      maxlength="300"><?php echo $CLEANCODED_facebook_description; ?></textarea>
            <small><i><?php _e('Facebook description length must be 300 symbols maximum.', 'cleancoded-ssb'); ?></i>
            </small>
            <?php if (isset($CLEANCODED_facebook_description_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_facebook_description_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <!-- End Facebook section -->

    <!-- Twitter section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('Twitter SSB', 'cleancoded-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="middle">
        <td scope="row">
            <label for="SocialShareTwitterTitle"><?php _e('Twitter Title', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <input id="SocialShareTwitterTitle" type="text" name="CLEANCODED_twitter_title"
                   value="<?php echo $CLEANCODED_twitter_title; ?>" maxlength="100"/>
            <small><i><?php _e('Twitter title length must be 70 symbols maximum.', 'cleancoded-ssb'); ?></i></small>
            <?php if (isset($CLEANCODED_twitter_title_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_twitter_title_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="pssTwitterText"><?php _e('Twitter Text', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <textarea id="CLEANCODED_twitter_text" name="CLEANCODED_twitter_text"
                      maxlength="116"><?php echo $CLEANCODED_twitter_text; ?></textarea>
            <small><i><?php _e('Twitter text length must be 116 symbols maximum.', 'cleancoded-ssb'); ?></i></small><br>
            <?php if (isset($CLEANCODED_twitter_text_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_twitter_text_error; ?></div>
            <?php endif; ?>
            <label><input type="radio" name="CLEANCODED_twitter_card" value="0" <?php echo ($CLEANCODED_twitter_card==0)?'checked="checked"' :''; ?>>Normal</label><br>
            <label><input type="radio" name="CLEANCODED_twitter_card" value="1" <?php echo ($CLEANCODED_twitter_card==1)?'checked="checked"' :''; ?>>Card</label><br>
            <label><input type="radio" name="CLEANCODED_twitter_card" value="2" <?php echo ($CLEANCODED_twitter_card==2)?'checked="checked"' :''; ?>>Large Card</label><br>
        </td>
    </tr>
    <!-- End Twitter section -->

    <!-- Linkedin section -->
    <tr valign="middle">
        <td colspan="2"><h4><?php _e('LinkedIn SSB', 'cleancoded-ssb'); ?></h4></td>
    </tr>
    <tr class="form-field" valign="middle">
        <td scope="row">
            <label for=" SocialShareLinkedinTitle"><?php _e('LinkedIn Title', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <input id="SocialShareLinkedinTitle" type="text" name="CLEANCODED_linkedin_title"
                   value="<?php echo $CLEANCODED_linkedin_title; ?>" maxlength="200"/>
            <small><i><?php _e('LinkedIn title length must be 200 symbols maximum.', 'cleancoded-ssb'); ?></i></small>
            <?php if (isset($CLEANCODED_linkedin_title_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_linkedin_title_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="form-field" valign="top">
        <td scope="row">
            <label for="SocialShareLlinkedinDescription"><?php _e('LinkedIn Description', 'cleancoded-ssb'); ?></label>
        </td>
        <td>
            <textarea id="SocialShareLinkedinDescription" name="CLEANCODED_linkedin_description"
                      maxlength="256"><?php echo $CLEANCODED_linkedin_description; ?></textarea>
            <small><i><?php _e('LinkedIn summary length must be 256 symbols maximum.', 'cleancoded-ssb'); ?></i></small>
            <?php if (isset($CLEANCODED_linkedin_description_error)): ?>
                <div class="field_error"><?php echo $CLEANCODED_linkedin_description_error; ?></div>
            <?php endif; ?>
        </td>
    </tr>
    <!-- End Linkedin section -->
</table>