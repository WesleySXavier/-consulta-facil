
<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require 'config.php';

$action = $_GET['action'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

if($action === 'medicos'){
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    $esp = $_GET['especialidade'] ?? '';
    $loc = $_GET['localizacao'] ?? '';
    if($id){
        $stmt = $pdo->prepare('SELECT * FROM medicos WHERE id = ?');
        $stmt->execute([$id]);
        $medicos = $stmt->fetchAll();
    } else {
        $sql = 'SELECT * FROM medicos WHERE 1=1';
        $params = [];
        if(strlen($esp)){
            $sql .= ' AND especialidade LIKE ?';
            $params[] = '%'.$esp.'%';
        }
        if(strlen($loc)){
            $sql .= ' AND localizacao LIKE ?';
            $params[] = '%'.$loc.'%';
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $medicos = $stmt->fetchAll();
    }
    echo json_encode(['success'=>true,'medicos'=>$medicos]);
    exit;
}

if($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $input['nome'] ?? '';
    $email = $input['email'] ?? '';
    $senha = $input['senha'] ?? '';
    if(!$nome || !$email || !$senha){
        echo json_encode(['success'=>false,'message'=>'Campos incompletos']);
        exit;
    }
    // ATENÇÃO: para fins didáticos armazenamos a senha em texto claro neste script.
    // Em produção, use password_hash() e nunca armazene em texto plano.
    try{
        $stmt = $pdo->prepare('INSERT INTO usuarios (nome,email,senha) VALUES (?,?,?)');
        $stmt->execute([$nome,$email,$senha]);
        echo json_encode(['success'=>true]);
    } catch(Exception $e){
        echo json_encode(['success'=>false,'message'=>'Erro: '.$e->getMessage()]);
    }
    exit;
}

if($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $input['email'] ?? '';
    $senha = $input['senha'] ?? '';
    if(!$email || !$senha){
        echo json_encode(['success'=>false,'message'=>'Informe e-mail e senha']);
        exit;
    }
    $stmt = $pdo->prepare('SELECT id,nome,email,senha FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $u = $stmt->fetch();
    if(!$u){
        echo json_encode(['success'=>false,'message'=>'Usuário não encontrado']);
        exit;
    }
    // comparação simples (senha em texto) - ajustar para password_verify em produção
    if($u['senha'] !== $senha){
        echo json_encode(['success'=>false,'message'=>'Senha inválida']);
        exit;
    }
    unset($u['senha']);
    echo json_encode(['success'=>true,'user'=>$u]);
    exit;
}

if($action === 'agendar' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_usuario = $input['id_usuario'] ?? null;
    $id_medico = $input['id_medico'] ?? null;
    $data_hora = $input['data_hora'] ?? null;
    if(!$id_usuario || !$id_medico || !$data_hora){
        echo json_encode(['success'=>false,'message'=>'Dados incompletos']);
        exit;
    }
    // verificar conflito simples: mesmo medico e mesmo horário
    $stmt = $pdo->prepare('SELECT COUNT(*) as c FROM consultas WHERE id_medico = ? AND data_hora = ?');
    $stmt->execute([$id_medico, $data_hora]);
    $r = $stmt->fetch();
    if($r && $r['c'] > 0){
        echo json_encode(['success'=>false,'message'=>'Horário indisponível']);
        exit;
    }
    $protocolo = strtoupper(substr(md5(uniqid()),0,10));
    $stmt = $pdo->prepare('INSERT INTO consultas (id_usuario,id_medico,data_hora,protocolo) VALUES (?,?,?,?)');
    $stmt->execute([$id_usuario,$id_medico,$data_hora,$protocolo]);
    echo json_encode(['success'=>true,'protocolo'=>$protocolo]);
    exit;
}

echo json_encode(['success'=>false,'message'=>'Ação inválida']);
