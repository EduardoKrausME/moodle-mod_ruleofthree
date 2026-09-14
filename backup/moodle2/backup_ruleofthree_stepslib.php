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
 * Backup structure step for mod_ruleofthree.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_ruleofthree_activity_structure_step extends backup_activity_structure_step {
    /**
     * Define the backup structure.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        $fields = [
            "course", "name", "intro", "introformat", "mode", "simplerelation",
            "simplea", "simpleb", "simplec", "simpled",
            "compounda1", "compounda2", "compoundb1", "compoundb2", "compoundr1", "compoundr2",
            "compoundarelation", "compoundbrelation", "precision", "timemodified",
        ];

        $ruleofthree = new backup_nested_element("ruleofthree", ["id"], $fields);
        $ruleofthree->set_source_table("ruleofthree", ["id" => backup::VAR_ACTIVITYID]);
        $ruleofthree->annotate_files("mod_ruleofthree", "intro", null);

        return $this->prepare_activity_structure($ruleofthree);
    }
}
