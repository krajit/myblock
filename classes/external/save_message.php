<?php
namespace block_myblock\external;

defined('MOODLE_INTERNAL') || die();

use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_single_structure;
use core_external\external_api;

class save_message extends external_api {

    public static function execute_parameters() {
        return new external_function_parameters([
            'message' => new external_value(PARAM_TEXT, 'Message text')
        ]);
    }

    public static function execute($message) {
        global $USER, $DB;

        require_login(); // <-- Add this

        self::validate_parameters(self::execute_parameters(), ['message' => $message]);

        $record = new \stdClass();
        $record->userid = $USER->id;
        $record->message = $message;
        $record->timecreated = time();

        $DB->insert_record('block_myblock_messages', $record);

        return ['status' => get_string('saved', 'block_myblock')];
    }

    public static function execute_returns() {
        return new external_single_structure([
            'status' => new external_value(PARAM_TEXT, 'Result status')
        ]);
    }
}
