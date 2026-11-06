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

namespace report_tarsus;

/**
 * Tests for the report_tarsus scaffold.
 *
 * @package    report_tarsus
 * @covers     ::report_tarsus_extend_navigation_course
 * @copyright  2026 lern.link GmbH | Vadym Nersesov <nersesov.vadim@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class lib_test extends \advanced_testcase {
    /**
     * A teacher sees the report node added to the course navigation.
     *
     * @return void
     */
    public function test_navigation_added_for_teacher(): void {
        global $CFG;
        require_once($CFG->dirroot . '/report/tarsus/lib.php');

        $this->resetAfterTest(true);

        $course = $this->getDataGenerator()->create_course();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'editingteacher');
        $this->setUser($teacher);

        $context = \context_course::instance($course->id);
        $navigation = new \navigation_node(['text' => 'root', 'key' => 'root']);

        report_tarsus_extend_navigation_course($navigation, get_course($course->id), $context);

        $this->assertNotNull(
            $navigation->find('report_tarsus', \navigation_node::TYPE_SETTING),
            'The report node was not added for a teacher.'
        );
    }

    /**
     * A student without the capability sees no report node.
     *
     * @return void
     */
    public function test_navigation_hidden_for_student(): void {
        global $CFG;
        require_once($CFG->dirroot . '/report/tarsus/lib.php');

        $this->resetAfterTest(true);

        $course = $this->getDataGenerator()->create_course();
        $student = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $this->setUser($student);

        $context = \context_course::instance($course->id);
        $navigation = new \navigation_node(['text' => 'root', 'key' => 'root']);

        report_tarsus_extend_navigation_course($navigation, get_course($course->id), $context);

        $this->assertFalse(
            $navigation->find('report_tarsus', \navigation_node::TYPE_SETTING),
            'The report node must be hidden from users without the view capability.'
        );
    }
}
