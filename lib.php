<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library hooks for report_tarsus.
 *
 * @package    report_tarsus
 * @copyright  2026 lern.link GmbH | Vadym Nersesov <nersesov.vadim@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Add the Tarsus analytics link to a course's Reports navigation.
 *
 * @param navigation_node $navigation The navigation node to extend.
 * @param stdClass        $course     The course object.
 * @param context_course  $context    The course context.
 * @return void
 */
function report_tarsus_extend_navigation_course(
    navigation_node $navigation,
    stdClass $course,
    context_course $context
): void {
    if (!has_capability('report/tarsus:view', $context)) {
        return;
    }

    $url = new moodle_url('/report/tarsus/index.php', ['courseid' => $course->id]);
    $navigation->add(
        get_string('pluginname', 'report_tarsus'),
        $url,
        navigation_node::TYPE_SETTING,
        null,
        'report_tarsus',
        new pix_icon('i/report', '')
    );
}
