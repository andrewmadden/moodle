// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Provides an interface for external tools in the Moodle server.
 *
 * @module     mod_lti/tool_all
 * @class      tool_all
 * @package    mod_lti
 * @copyright  2020 Andrew Madden <andrewmadden@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.11
 */
define(['core/ajax', 'core/notification'], function(ajax, notification) {
    return /** @alias module:mod_lti/tool_all */ {
        /**
         * Get a list of LTI tool types and tool proxies from Moodle for the given
         * search args.
         *
         * See also:
         * mod/lti/classes/external.php get_tool_types_and_proxies()
         *
         * @method query
         * @public
         * @param {Object} args Search parameters
         * @return {Promise} jQuery Deferred object
         */
        query: function(args) {
            var request = {
                methodname: 'mod_lti_get_tool_types_and_proxies',
                args: args || {}
            };

            var promise = ajax.call([request])[0];

            promise.fail(notification.exception);

            return promise;
        },

        /**
         * Get a count of LTI tool types and tool proxies from Moodle for the given
         * search args.
         *
         * See also:
         * mod/lti/classes/external.php get_tool_types_and_proxies_count()
         *
         * @method count
         * @public
         * @param {Object} args Search parameters
         * @return {Promise} jQuery Deferred object
         */
        count: function(args) {
            var request = {
                methodname: 'mod_lti_get_tool_types_and_proxies_count',
                args: args || {}
            };

            var promise = ajax.call([request])[0];

            promise.fail(notification.exception);

            return promise;
        }
    };
});
