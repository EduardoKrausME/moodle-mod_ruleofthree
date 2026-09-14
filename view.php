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
 * Main activity page for mod_ruleofthree.
 *
 * @package   mod_ruleofthree
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . "/../../config.php");

$id = required_param("id", PARAM_INT);
$cm = get_coursemodule_from_id("ruleofthree", $id, 0, false, MUST_EXIST);
$course = get_course($cm->course);
$activity = $DB->get_record("ruleofthree", ["id" => $cm->instance], "*", MUST_EXIST);

require_login($course, true, $cm);
require_capability("mod/ruleofthree:view", context_module::instance($cm->id));

$PAGE->set_url("/mod/ruleofthree/view.php", ["id" => $cm->id]);
$PAGE->set_title(format_string($activity->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context(context_module::instance($cm->id));

$completion = new completion_info($course);
$completion->set_module_viewed($cm);

$PAGE->requires->strings_for_js([
    "invalidnumber",
    "equation",
    "substitution",
    "result",
    "proportionmaintained",
    "direct",
    "inverse",
    "factor",
], "mod_ruleofthree");

$config = [
    "mode" => $activity->mode,
    "precision" => (int)$activity->precision,
    "simple" => [
        "relation" => $activity->simplerelation,
        "values" => [
            (float)$activity->simplea,
            (float)$activity->simpleb,
            (float)$activity->simplec,
            (float)$activity->simpled,
        ],
    ],
    "compound" => [
        "relationA" => $activity->compoundarelation,
        "relationB" => $activity->compoundbrelation,
        "values" => [
            (float)$activity->compounda1,
            (float)$activity->compounda2,
            (float)$activity->compoundb1,
            (float)$activity->compoundb2,
            (float)$activity->compoundr1,
            (float)$activity->compoundr2,
        ],
    ],
];

$template = [
    "simple" => $activity->mode === "simple",
    "compound" => $activity->mode === "compound",
    "intro" => format_module_intro("ruleofthree", $activity, $cm->id, false),
    "simplevalues" => [
        [
            "key" => "a",
            "label" => get_string("simplea", "mod_ruleofthree"),
            "value" => format_float($activity->simplea, $activity->precision),
        ],
        [
            "key" => "b",
            "label" => get_string("simpleb", "mod_ruleofthree"),
            "value" => format_float($activity->simpleb, $activity->precision),
        ],
        [
            "key" => "c",
            "label" => get_string("simplec", "mod_ruleofthree"),
            "value" => format_float($activity->simplec, $activity->precision),
        ],
        [
            "key" => "d",
            "label" => get_string("simpled", "mod_ruleofthree"),
            "value" => format_float($activity->simpled, $activity->precision),
        ],
    ],
    "compoundrows" => [
        [
            "label" => get_string("quantitya", "mod_ruleofthree"),
            "key1" => "a1",
            "key2" => "a2",
            "value1" => format_float($activity->compounda1, $activity->precision),
            "value2" => format_float($activity->compounda2, $activity->precision),
        ],
        [
            "label" => get_string("quantityb", "mod_ruleofthree"),
            "key1" => "b1",
            "key2" => "b2",
            "value1" => format_float($activity->compoundb1, $activity->precision),
            "value2" => format_float($activity->compoundb2, $activity->precision),
        ],
        [
            "label" => get_string("compoundresult", "mod_ruleofthree"),
            "key1" => "r1",
            "key2" => "r2",
            "value1" => format_float($activity->compoundr1, $activity->precision),
            "value2" => format_float($activity->compoundr2, $activity->precision),
        ],
    ],
];

$PAGE->requires->js_call_amd("mod_ruleofthree/calculator", "init", [$config]);

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($activity->name));
echo $OUTPUT->render_from_template("mod_ruleofthree/calculator", $template);
echo $OUTPUT->footer();
