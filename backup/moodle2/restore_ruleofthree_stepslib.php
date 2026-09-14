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
 * Restore structure step for mod_ruleofthree.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_ruleofthree_activity_structure_step extends restore_activity_structure_step {
    /**
     * Define restore paths.
     *
     * @return array
     */
    protected function define_structure(): array {
        return $this->prepare_activity_structure([
            new restore_path_element("ruleofthree", "/activity/ruleofthree"),
        ]);
    }

    /**
     * Process one activity record.
     *
     * @param array $data Record data.
     * @return void
     */
    protected function process_ruleofthree(array $data): void {
        global $DB;

        $record = (object) $data;
        unset($record->id);
        $record->course = $this->get_courseid();
        $newitemid = $DB->insert_record("ruleofthree", $record);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Restore activity files.
     *
     * @return void
     */
    protected function after_execute(): void {
        $this->add_related_files("mod_ruleofthree", "intro", null);
    }
}
