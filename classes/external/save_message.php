<?php
namespace block_myblock\external;

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/externallib.php');

use external_function_parameters;
use external_value;
use external_single_structure;
use external_api;

class save_message extends external_api {

    public static function execute_parameters() {
        return new external_function_parameters([
            'message' => new external_value(PARAM_TEXT, 'Message text')
        ]);
    }

    public static function execute($message) {
        global $USER, $DB;

        require_login();

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
