<?php

namespace MediaWiki\Extension\UserRightsLink;

use MediaWiki\Hook\UserToolLinksEditHook;
use MediaWiki\Linker\LinkRenderer;
use RequestContext;
use SpecialPage;

class MainHooks implements UserToolLinksEditHook {
	/** @var LinkRenderer */
	protected LinkRenderer $linkRenderer;

	/**
	 * Constructor
	 *
	 * @param LinkRenderer $linkRenderer
	 */
	public function __construct( LinkRenderer $linkRenderer ) {
		$this->linkRenderer = $linkRenderer;
	}

	/**
	 * Add a "rights" link for privileged users
	 *
	 * @param int $userId User ID of the current user
	 * @param string $userText Username of the current user
	 * @param string[] &$items Array of user tool links as HTML fragments
	 * @return void
	 *
	 */
	public function onUserToolLinksEdit( $userId, $userText, &$items ) {
		$showLink = RequestContext::getMain()->getTitle()->isSpecial( 'Listusers' );
		$canEditRights = RequestContext::getMain()->getAuthority()->isAllowed( 'userrights' );
		if ( $userId && $showLink && $canEditRights ) {
			$items[] = $this->linkRenderer->makeKnownLink(
				SpecialPage::getTitleFor( 'Userrights', $userText ),
				wfMessage( 'userrightslink' )->text(),
				[ 'class' => 'mw-usertoollinks-userrights' ]
			);
		}
	}
}
