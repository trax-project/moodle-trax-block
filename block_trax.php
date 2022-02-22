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

class block_trax extends block_base {

    public function init() {
        $this->title = get_string('title', 'block_trax');
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function applicable_formats() {
        return array('course-view' => true);
    }

    public function instance_allow_config() {
        return false;
    }

    public function get_content() {
        global $COURSE;
        
        // Make this block invisible for those who are not allowed to manage this course.
        if (!has_capability('moodle/course:update', context_course::instance($COURSE->id))) {
            return;
        }

        // Text.
        $target = \logstore_trax\src\config::course_target($COURSE->id);
        $text = '<p>'.get_string('target_'.$target, 'block_trax').'</p>';

        // Link for configuration.
        $url = new moodle_url('/blocks/trax/view.php', [
            'blockid' => $this->instance->id,
            'courseid' => $COURSE->id
        ]);

        // Content.
        $this->content = new stdClass;
        $this->content->text = $text;
        $this->content->footer = html_writer::link($url, get_string('configure', 'block_trax'));
        return $this->content;
    }
}
