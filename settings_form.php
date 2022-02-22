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

require_once("{$CFG->libdir}/formslib.php");

class settings_form extends moodleform {
    
    function definition() {

        $mform =& $this->_form;

        // Hidden elements.
        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);
        $mform->addElement('hidden', 'blockid');
        $mform->setType('blockid', PARAM_INT);

        // Target select.
        $mform->addElement(
            'select',
            'target',
            get_string('target', 'block_trax'),
            \logstore_trax\src\config::targets()
        );

        $this->add_action_buttons();
    }
}