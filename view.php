<?php

/* * *************************************************************
 *  This script has been developed for Moodle - http://moodle.org/
 *
 *  You can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
  *
 * ************************************************************* */

require_once('../../config.php');
require_once('settings_form.php');

global $DB, $OUTPUT, $PAGE;

$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);

// Check course id.
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse');
}
require_login($course);

// Header.
$PAGE->set_url('/blocks/trax/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('pluginname', 'block_trax'));

// Form definition.
$form = new settings_form();
$form->set_data(['courseid' => $courseid, 'blockid' => $blockid]);

// Form processing.
if ($form->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
    redirect($courseurl);
} elseif ($form->get_data()) {
    // Form validated. We record the settings and we go back to the course page.
    \logstore_trax\src\config::set_course_target($courseid, $form->get_data()->target);
    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
    redirect($courseurl);
} else {
    // Form didn't validate or this is the first display.
    echo $OUTPUT->header();
    $form->display();
    echo $OUTPUT->footer();
}
