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
 * Folder module version information
 *
 * @package    provafacil
 * @copyright  2015-2024 UnISCED. - www.unisced.edu.mz
 * @author     osvaldo Simone
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 $plugin->version = 2024111800; 
// $plugin->version   = 2022041900;
$plugin->requires = 2022041900;
 //$plugin->version   = 2024102200;        // Versão do plugin (data YYYYMMDDXX)
 //$plugin->requires  = 2022112800;        // Versão mínima do Moodle (4.1)
 $plugin->component = 'mod_provafacil';  // Nome do componente (único)
 $plugin->maturity  = MATURITY_STABLE;   // Maturidade do plugin
 $plugin->release   = '1.0';             // Versão de lançamento