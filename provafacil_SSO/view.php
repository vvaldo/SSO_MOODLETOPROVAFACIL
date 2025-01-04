<?php

require('../../config.php');
require_once("$CFG->dirroot/mod/provafacil/lib.php");
require_login();


$id = required_param('id', PARAM_INT); // ID do curso


// Buscar os detalhes da instância da atividade
$cm = get_coursemodule_from_id('provafacil', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$provafacil = $DB->get_record('provafacil', array('id' => $cm->instance), '*', MUST_EXIST);

// Requerer login
require_login($course, true, $cm);
$PAGE->set_url('/mod/provafacil/view.php', ['id' => $id]);
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));

// Obter o nome de usuário atual para envio ao Prova Fácil
$username = $USER->email;
$nome = $USER->firstname; // Primeiro nome
$ultimo_nome = $USER->lastname; // Sobrenome

// Função para exibir a tela de confirmação antes do redirecionamento

function exibir_tela_confirmacao($nome, $username, $token, $exam_url, $course) {
    
    global $DB, $PAGE, $OUTPUT;

    // Verificar permissões de administrador
    require_login();
    
    // Configurações da página


    $PAGE->set_title('Confirmação de Acesso à Prova Via SSO');
    $PAGE->set_heading('Confirmação de Acesso à Prova Via SSO');
    echo $OUTPUT->header();

    echo "<h2>Confirmação de Acesso à Prova</h2>";
    echo "<p>Olá <strong>" . htmlspecialchars($nome) . "</strong>,</p>";
    echo "<p>Você está prestes a acessar a Prova Fácil via SSO .</p>";
    echo "<p>A Prova Facil e um Sistema de realização de avaliacoes e Exames da UnISCED. </p>";
    echo "<p>Caso tenha alguma dúvida ou precise de assistência, basta solicitar apoio via Helpdesk ou entrar em contato com o centro de recursos. </p>";
    echo "<p>Deseja continuar?</p>";

    // Formulário para confirmação ou cancelamento
    echo '<form method="POST" action="">
            <input type="hidden" name="confirm" value="yes">
            <button type="submit">Continuar</button>
            <button type="button" onclick="window.location.href=\'' . new moodle_url('/course/view.php', array('id' => $course->id)) . '\'">Cancelar</button>
          </form>';
     // Rodapé do Moodle
   
     
}

// Dados para o POST
$data = array(
    "username" => $username,
    "is_candidate" => true
);

// Configuração da requisição
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ),
);

// URL da API do Prova Fácil
$url = "https://sso.provafacilnaweb.com.br/universallogin/generate-token";

// Realizar a requisição POST
$context  = stream_context_create($options);

try {
    // Suprimir warnings e capturar erros
    $response = @file_get_contents($url, false, $context);

    // Verificar a resposta
    if ($response === FALSE) {
        throw new Exception('Erro ao obter token. Não foi possível acessar o servidor SSO.');
    }

    // Decodificar o JSON de resposta
    $result = json_decode($response, true);

    if (isset($result['token'])) {
        $token = $result['token'];
        $exam_url = "https://unisced.provafacilnaweb.com.br/unisced/sso/?ticket=" . $token . "&is_candidate=true";

        // Exibir a tela de confirmação antes de redirecionar
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            // Redirecionar o aluno para o Prova Fácil com o token após a confirmação
            redirect($exam_url);
        } else {
            // Chamar a função de confirmação
            exibir_tela_confirmacao($nome, $username, $token, $exam_url, $course);
        }
    } else {
        throw new Exception('Token não encontrado na resposta.');
    }

} catch (Exception $e) {
    // Exibir mensagem de erro
    echo '<div style="text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 8px; max-width: 600px; margin: 0 auto;">';
    echo '<h3>Erro</h3>';
    echo '<p>' . $e->getMessage() . '</p>';
    echo '<p>Redirecionando para a página inicial do curso em 5 segundos...</p>';
    echo '</div>';

    // Redirecionamento após 5 segundos
    echo '<script>
            setTimeout(function() {
                window.location.href = "' . new moodle_url('/course/view.php', array('id' => $course->id)) . '";
            }, 5000);
          </script>';
}
