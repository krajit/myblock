<?php
namespace block_myblock\external;

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/externallib.php');

use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use external_api;

class get_messages extends external_api {

    public static function execute_parameters() {
        return new external_function_parameters([]);
    }

    public static function execute() {
        global $USER, $DB;

        require_login();

        $records = $DB->get_records('block_myblock_messages', ['userid' => $USER->id], 'timecreated DESC');

        $result = [];
        foreach ($records as $record) {
            $result[] = [
                'message' => $record->message,
                'timecreated' => userdate($record->timecreated)
            ];
        }

        return $result;
    }

    public static function execute_returns() {
        return new external_multiple_structure(
            new external_single_structure([
                'message' => new external_value(PARAM_TEXT, 'Message'),
                'timecreated' => new external_value(PARAM_TEXT, 'Time created'),
            ])
        );
    }
}
