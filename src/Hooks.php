<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @file
 */

namespace MediaWiki\Extension\IncidentReporting;

use MediaWiki\Hook\BeforePageDisplayHook;
use OutputPage;
use Skin;

class Hooks implements BeforePageDisplayHook {

	/**
	 * @param OutputPage $out
	 * @param Skin $skin
	 * Hook: BeforePageDisplay
	 */
	public function onBeforePageDisplay( $out, $skin ): void {
		/** If IncidentReporting is not enabled do nothing. */
		if ( !$out->getConfig()->get( 'IncidentReportingReportButtonEnabled' ) ) {
			return;
		}

		/** If IncidentReporting is enabled check we are in correct namespace and skin then add modules */
		if ( in_array( $out->getTitle()->getNamespace(),
				$out->getConfig()->get( 'IncidentReportingEnabledNamespaces' ) ) &&
			in_array( $skin->getSkinName(), $out->getConfig()->get( 'IncidentReportingEnabledSkins' ) ) ) {
			$out->addModules( [ 'ext.incidentReporting' ] );
			$out->addHtml( '<div id="ext-incidentreporting-app"></div>' );
		}
	}
}
