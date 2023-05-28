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
	 * Register parser hook
	 *
	 * @param Parser &$parser
	 * @return bool
	 */
	public static function AddThisHeaderTag( &$parser ) {
		$parser->setHook( 'addthis', __CLASS__ . '::parserHook' );

		return true;
	}

	

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

    # Output the new social sharing widget
    $wgOut->addHTML('<div id="social-sharing-widget"></div>
        <script>
          function generateSocialSharingWidget() {
            var url = window.location.href;
            var socialSharingHTML = \'<div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="\' + url + \'" data-a2a-title="Check out this awesome website!">\'
              + \'<a class="a2a_button_facebook"></a>\'
              + \'<a class="a2a_button_twitter"></a>\'
              + \'<a class="a2a_button_linkedin"></a>\'
              + \'<a class="a2a_button_email"></a>\'
              + \'<a class="a2a_button_pinterest"></a>\'
              + \'<a class="a2a_button_reddit"></a>\'
              + \'<a class="a2a_button_tumblr"></a>\'
              + \'<a class="a2a_button_instagram"></a>\'
              + \'<a class="a2a_dd" href="https://www.addtoany.com/share"></a>\'
              + \'</div>\';

            var socialSharingStyle = \'<style>\'
+ \'#social-sharing-widget { float: right; top: 10px; right: 10px; }\'
              + \'.a2a_kit {\'
              + \'border: 2px solid #999;\'
              + \'border-radius: 3px;\'
              + \'padding: 5px;\'
              + \'display: inline-block;\'
              + \'background-color: #f6f6f6;\'
              + \'box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);\'
              + \'}\'
              + \'.a2a_button {\'
              + \'margin-right: 5px;\'
              + \'width: 20px;\'
              + \'height: 20px;\'
              + \'}\'
              + \'.a2a_kit_size_32 {\'
              + \'width: auto;\'
              + \'}\'
              + \'</style>\';

            var wrapper = document.createElement(\'div\');
            wrapper.innerHTML = socialSharingStyle + socialSharingHTML;
            document.getElementById(\'social-sharing-widget\').appendChild(wrapper);

            var script = document.createElement(\'script\');
            script.async = true;
            script.src = \'https://static.addtoany.com/menu/page.js\';
            document.getElementById(\'social-sharing-widget\').appendChild(script);
          }

          generateSocialSharingWidget();
        </script>');

    return true;
}




	

	

}
