<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Block myblock is defined here.
 *
 * @package     block_myblock
 * @copyright   2025 Your Name <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_myblock extends block_base {

    /**
     * Initializes class member variables.
     */
    public function init() {
        // Needed by Moodle to differentiate between blocks.
        $this->title = get_string('pluginname', 'block_myblock');
    }

    // /**
    //  * Returns the block contents.
    //  *
    //  * @return stdClass The block contents.
    //  */
    // public function get_content() {

    //     if ($this->content !== null) {
    //         return $this->content;
    //     }

    //     if (empty($this->instance)) {
    //         $this->content = '';
    //         return $this->content;
    //     }

    //     $this->content = new stdClass();
    //     $this->content->items = [];
    //     $this->content->icons = [];
    //     $this->content->footer = '';

    //     if (!empty($this->config->text)) {
    //         $this->content->text = $this->config->text;
    //     } else {
    //         $text = 'Please define the content text in /blocks/myblock/block_myblock.php.';
    //         $this->content->text = $text;
    //     }

    //     return $this->content;
    // }

    public function get_content() {
        global $OUTPUT;

        if ($this->content !== null) return $this->content;

        $this->page->requires->js_call_amd('block_myblock/form', 'init');

        $data = [
            'submit' => get_string('submit', 'block_myblock'),
            'placeholder' => get_string('placeholder', 'block_myblock')
        ];

        $this->content = new stdClass();
        $this->content->text = $OUTPUT->render_from_template('block_myblock/form', $data);
        $this->content->footer = '';

        $this->page->requires->js_call_amd('block_myblock/form', 'init');
        return $this->content;
    }



    /**
     * Defines configuration data.
     *
     * The function is called immediately after init().
     */
    public function specialization() {

        // Load user defined title and make sure it's never empty.
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname', 'block_myblock');
        } else {
            $this->title = $this->config->title;
        }
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    public function applicable_formats() {
        return [
            '' => true,
        ];
    }

    // public function get_required_javascript() {
    //     $this->page->requires->js_call_amd('block_myblock/form', 'init');
    // }
}
