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
 * provafacil configuration form
 *
 * @package    provafacil
 * @copyright  2015-2024 UnISCED. - www.unisced.edu.mz
 * @author     osvaldo Simone
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

 */

defined('MOODLE_INTERNAL') || die;

/**
 * List of features supported in URL module
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know or string for the module purpose.
 */
function provafacil_add_instance($data, $mform) {
    global $DB;

    // Adicionar a instância da atividade no banco de dados
    $data->timecreated = time();
    $data->id = $DB->insert_record('provafacil', $data);

    return $data->id;
}

function provafacil_update_instance($data, $mform) {
    global $DB;

    // Atualizar a instância da atividade
    $data->timemodified = time();
    $data->id = $data->instance;
    return $DB->update_record('provafacil', $data);
}

function provafacil_add_log($userid, $token, $action, $url_generated) {
    global $DB;

    $log = new stdClass();
    $log->userid = $userid;
    $log->token = $token;
    $log->action = $action;
    $log->url_generated = $url_generated;
    $log->timecreated = time();

    // Inserir o log no banco de dados
    $DB->insert_record('provafacil_logs', $log);
}
function provafacil_get_coursemodule_info($coursemodule) {
    global $OUTPUT;
    
    $info = new cached_cm_info();
    
    // Adicionando o ícone ao curso usando $OUTPUT->image_url
    $info->icon = $OUTPUT->image_url('icon', 'provafacil')->out();

    return $info;
}
