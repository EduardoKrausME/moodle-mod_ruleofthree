<?php
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
 * Activity configuration form for mod_ruleofthree.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("{$CFG->dirroot}/course/moodleform_mod.php");

/**
 * Activity configuration form.
 */
class mod_ruleofthree_mod_form extends moodleform_mod {
    /**
     * Define the form.
     *
     * @return void
     */
    public function definition(): void {
        $mform = $this->_form;

        $mform->addElement("text", "name", get_string("name"), ["size" => 64]);
        $mform->setType("name", PARAM_TEXT);
        $mform->addRule("name", null, "required", null, "client");

        $this->standard_intro_elements();

        $mform->addElement("select", "mode", get_string("mode", "mod_ruleofthree"), [
            "simple" => get_string("modesimple", "mod_ruleofthree"),
            "compound" => get_string("modecompound", "mod_ruleofthree"),
        ]);
        $mform->setDefault("mode", "simple");

        $mform->addElement("select", "precision",
            get_string("precision", "mod_ruleofthree"),
            array_combine(range(0, 6), range(0, 6)));
        $mform->setDefault("precision", 2);

        $mform->addElement("html", html_writer::tag("h3", get_string("simplevalues", "mod_ruleofthree")));
        $mform->hideIf("simpleheader", "mode", "neq", "simple");

        $mform->addElement("select", "simplerelation", get_string("relation", "mod_ruleofthree"), [
            "direct" => get_string("direct", "mod_ruleofthree"),
            "inverse" => get_string("inverse", "mod_ruleofthree"),
        ]);
        $mform->setDefault("simplerelation", "direct");
        $mform->hideIf("simplerelation", "mode", "neq", "simple");

        $this->add_number($mform, "simplea", "simplea", 2, "simple");
        $this->add_number($mform, "simpleb", "simpleb", 4, "simple");
        $this->add_number($mform, "simplec", "simplec", 3, "simple");
        $this->add_number($mform, "simpled", "simpled", 6, "simple");

        $mform->addElement("html", html_writer::tag("h3", get_string("compoundvalues", "mod_ruleofthree")));
        $mform->hideIf("compoundheader", "mode", "neq", "compound");

        $this->add_number($mform, "compounda1", "compounda1", 2, "compound");
        $this->add_number($mform, "compounda2", "compounda2", 4, "compound");
        $this->add_number($mform, "compoundb1", "compoundb1", 3, "compound");
        $this->add_number($mform, "compoundb2", "compoundb2", 6, "compound");
        $this->add_number($mform, "compoundr1", "compoundr1", 10, "compound");
        $this->add_number($mform, "compoundr2", "compoundr2", 40, "compound");

        $mform->addElement("html", html_writer::tag("h3", get_string("compoundrelations", "mod_ruleofthree")));
        $mform->hideIf("compoundrelationsheader", "mode", "neq", "compound");

        $relations = [
            "direct" => get_string("direct", "mod_ruleofthree"),
            "inverse" => get_string("inverse", "mod_ruleofthree"),
        ];
        $mform->addElement("select", "compoundarelation", get_string("compoundarelation", "mod_ruleofthree"), $relations);
        $mform->setDefault("compoundarelation", "direct");
        $mform->hideIf("compoundarelation", "mode", "neq", "compound");
        $mform->addElement("select", "compoundbrelation", get_string("compoundbrelation", "mod_ruleofthree"), $relations);
        $mform->setDefault("compoundbrelation", "direct");
        $mform->hideIf("compoundbrelation", "mode", "neq", "compound");

        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    /**
     * Add a numeric field.
     *
     * @param MoodleQuickForm $mform Moodle form.
     * @param string $name Field name.
     * @param string $string String key.
     * @param float $default Default value.
     * @param string $mode Visible mode.
     * @return void
     */
    private function add_number(MoodleQuickForm $mform, string $name, string $string, float $default, string $mode): void {
        $mform->addElement("text", $name, get_string($string, "mod_ruleofthree"), ["size" => 14]);
        $mform->setType($name, PARAM_FLOAT);
        $mform->setDefault($name, $default);
        $mform->addRule($name, null, "numeric", null, "client");
        $mform->hideIf($name, "mode", "neq", $mode);
    }
}
