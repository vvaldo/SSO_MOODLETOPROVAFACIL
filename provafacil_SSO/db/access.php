<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'mod/provafacil:addinstance' => array(
        'riskbitmask' => RISK_XSS, // Risco associado a esta capacidade
        'captype' => 'write', // Tipo de capacidade (escrita)
        'contextlevel' => CONTEXT_MODULE, // Nível de contexto (módulo)
        'archetypes' => array( // Permissões padrão
            'student' => CAP_PREVENT, // Estudantes não podem adicionar
            'teacher' => CAP_ALLOW, // Professores podem adicionar
            'editingteacher' => CAP_ALLOW, // Professores que editam podem adicionar
            'manager' => CAP_ALLOW, // Gestores podem adicionar
        ),
    ),

    'mod/provafacil:view' => array(
    'riskbitmask' => RISK_XSS,
    'captype' => 'read',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
        'student' => CAP_ALLOW,
        'teacher' => CAP_ALLOW,
        'editingteacher' => CAP_ALLOW,
        'manager' => CAP_ALLOW,
    ),
),


    // Adicione outras capacidades se necessário.
);
