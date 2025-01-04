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

require_once ($CFG->dirroot.'/course/moodleform_mod.php');
// require_once($CFG->dirroot.'/mod/url/locallib.php');

class mod_provafacil_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;

        //$mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('activityname', 'provafacil'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
       // $mform->addRule('name', null, 'required', null, 'client');
      //  $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

      //  $this->standard_intro_elements(get_string('description', 'assign'));





        // Adicionando o campo nome da atividade
       // $mform->addElement('text', 'name', get_string('activityname', 'provafacil'));
       // $mform->setType('name', PARAM_TEXT);
       // $mform->addRule('name', null, 'required', null, 'client');
      //  $mform->addElement('text', 'name', get_string('name'), array('size'=>'48'));
      //  if (!empty($CFG->formatstringstriptags)) {
      //      $mform->setType('name', PARAM_TEXT);
     //   } else {
     //       $mform->setType('name', PARAM_CLEANHTML);
     //   }
    //    $mform->addRule('name', null, 'required', null, 'client');
   //     $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
       // $mform->addElement('editor', 'intro', get_string('moduleintro', 'provafacil'));
       // $mform->setType('intro', PARAM_RAW);
       // $mform->addRule('intro', null, 'required', null, 'client');
        // Adiciona o formato da introdução.
       // $mform->addElement('hidden', 'introformat');
       // $mform->setType('introformat', PARAM_INT);


        // Campo de detalhes (descrição da prova)
        //$mform->addElement('editor', 'details', get_string('details', 'provafacil'), null, null);
       // $mform->setType('details', PARAM_RAW); // Campo de texto completo
        

        // Campo para definir a disponibilidade (data de início e fim)
       // $mform->addElement('date_selector', 'availability_start', get_string('availability_start', 'provafacil'));
       // $mform->addElement('date_selector', 'availability_end', get_string('availability_end', 'provafacil'));
        // Campos adicionais podem ser adicionados aqui
        $this->standard_coursemodule_elements();

        // Botão para salvar
        $this->add_action_buttons();
    }
}

