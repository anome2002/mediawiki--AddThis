<?php

use MediaWiki\MediaWikiServices;

/**
 * Class file for the AddThis extension
 *
 * @addtogroup Extensions
 * @license GPL-2.0-only
 */
class AddThis {


	/**
	 * Function for article header toolbar
	 *
	 * @param Article &$article
	 * @param bool &$outputDone
	 * @param bool &$pcache
	 * @return bool|bool
	 */
public static function AddThisHeader(&$article, &$outputDone, &$pcache) {
    global $wgOut, $wgAddThispubid, $wgAddThisHeader, $wgAddThisMain;

    # Check if page is in content namespace and the setting to enable/disable
    # article header toolbar either on the main page or at all
    if (!MediaWikiServices::getInstance()->getNamespaceInfo()->isContent($article->getTitle()->getNamespace())
        || !$wgAddThisHeader
        || ($article->getTitle()->equals(Title::newMainPage()) && !$wgAddThisMain)
    ) {
        return true;
    }

    # Localisation for "Share"
    $share = wfMessage('addthis')->escaped();

  // Output the new social sharing widget
$wgOut->addHTML('
    <div id="social-sharing-widget"></div>
    <script>
        function generateSocialSharingWidget() {
            var url = window.location.href;
            var socialSharingHTML = \'<div class="a2a_kit a2a_kit_size_21 a2a_default_style" data-a2a-url="\' + url + \'" data-a2a-title="Check out this awesome website!">\'
                + \'<a class="a2a_button_facebook"></a>\'
                + \'<a class="a2a_button_twitter"></a>\'
                + \'<a class="a2a_button_linkedin"></a>\'
                + \'<a class="a2a_button_email"></a>\'
                + \'<a class="a2a_button_pinterest"></a>\'
                + \'<a class="a2a_button_reddit"></a>\'
                + \'<a class="a2a_button_tumblr"></a>\'
                + \'<a class="a2a_button_whatsapp"></a>\'
                + \'<a class="a2a_dd" href="https://www.addtoany.com/share"></a>\'
                + \'</div>\';
            
            var socialSharingStyle = \'<style>\'
                + \'#social-sharing-widget { float: right; top: 10px; right: 10px; }\'
                + \'.a2a_kit { border: 2px solid #999; border-radius: 3px; padding: 5px; display: inline-block; background-color: #f6f6f6; box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); }\'
                + \'.a2a_button { margin-right: 5px; width: 20px; height: 20px; }\'
                + \'.a2a_kit_size_32 { width: auto; }\'
                + \'</style>\';

            var wrapper = document.createElement(\'div\');
            wrapper.innerHTML = socialSharingStyle + socialSharingHTML;
            document.getElementById(\'social-sharing-widget\').appendChild(wrapper);
        }

        function loadSocialSharingWidget() {
            var script = document.createElement(\'script\');
            script.src = \'https://static.addtoany.com/menu/page.js\';
  script.async = true;
            document.getElementById(\'social-sharing-widget\').appendChild(script);
        }

        if (document.readyState === "complete") {
            generateSocialSharingWidget();
            loadSocialSharingWidget();
        } else {
            window.addEventListener(\'load\', function () {
                generateSocialSharingWidget();
                loadSocialSharingWidget();
            });
        }
    </script>
');

return true;
}

	

}








	

	


