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
 * Moodle callbacks for mod_ruleofthree.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return supported activity features.
 *
 * @param string $feature Feature constant.
 * @return bool|string|null
 */
function ruleofthree_supports(string $feature): bool|string|null {
    return match ($feature) {
        FEATURE_MOD_INTRO => true,
        FEATURE_SHOW_DESCRIPTION => true,
        FEATURE_COMPLETION_TRACKS_VIEWS => true,
        FEATURE_BACKUP_MOODLE2 => true,
        FEATURE_MOD_PURPOSE => MOD_PURPOSE_OTHER,
        default => null,
    };
}

/**
 * Add an instance.
 *
 * @param object $data Form data.
 * @param mod_ruleofthree_mod_form|null $mform Form object.
 * @return int
 */
function ruleofthree_add_instance(object $data, ?mod_ruleofthree_mod_form $mform = null): int {
    return \mod_ruleofthree\manager::add($data);
}

/**
 * Update an instance.
 *
 * @param object $data Form data.
 * @param mod_ruleofthree_mod_form|null $mform Form object.
 * @return bool
 */
function ruleofthree_update_instance(object $data, ?mod_ruleofthree_mod_form $mform = null): bool {
    return \mod_ruleofthree\manager::update($data);
}

/**
 * Delete an instance.
 *
 * @param int $id Instance id.
 * @return bool
 */
function ruleofthree_delete_instance(int $id): bool {
    return \mod_ruleofthree\manager::delete($id);
}
