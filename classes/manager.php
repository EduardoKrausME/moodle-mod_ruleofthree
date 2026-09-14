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

namespace mod_ruleofthree;

/**
 * Instance manager.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager {
    /**
     * Add a new activity instance.
     *
     * @param object $data Form data.
     * @return int
     */
    public static function add(object $data): int {
        global $DB;

        self::normalise($data);
        $data->timemodified = time();

        return $DB->insert_record("ruleofthree", $data);
    }

    /**
     * Update an activity instance.
     *
     * @param object $data Form data.
     * @return bool
     */
    public static function update(object $data): bool {
        global $DB;

        $data->id = $data->instance;
        self::normalise($data);
        $data->timemodified = time();

        return $DB->update_record("ruleofthree", $data);
    }

    /**
     * Delete an activity instance.
     *
     * @param int $id Instance id.
     * @return bool
     */
    public static function delete(int $id): bool {
        global $DB;

        if (!$DB->record_exists("ruleofthree", ["id" => $id])) {
            return false;
        }

        $DB->delete_records("ruleofthree", ["id" => $id]);
        return true;
    }

    /**
     * Ensure stored defaults satisfy the configured proportion.
     *
     * @param object $data Form data.
     * @return void
     */
    private static function normalise(object $data): void {
        $numericfields = [
            "simplea", "simpleb", "simplec", "simpled",
            "compounda1", "compounda2", "compoundb1", "compoundb2", "compoundr1", "compoundr2",
        ];

        foreach ($numericfields as $field) {
            if (!isset($data->{$field}) || !is_numeric($data->{$field}) || (float) $data->{$field} == 0.0) {
                $data->{$field} = 1.0;
            } else {
                $data->{$field} = (float) $data->{$field};
            }
        }

        if (($data->simplerelation ?? "direct") === "inverse") {
            $data->simpled = ($data->simplea * $data->simpleb) / $data->simplec;
        } else {
            $data->simpled = ($data->simpleb * $data->simplec) / $data->simplea;
        }

        $factora = ($data->compoundarelation ?? "direct") === "inverse"
            ? $data->compounda1 / $data->compounda2
            : $data->compounda2 / $data->compounda1;
        $factorb = ($data->compoundbrelation ?? "direct") === "inverse"
            ? $data->compoundb1 / $data->compoundb2
            : $data->compoundb2 / $data->compoundb1;
        $data->compoundr2 = $data->compoundr1 * $factora * $factorb;

        $data->precision = max(0, min(6, (int) ($data->precision ?? 2)));
    }
}
