<?php

namespace src\controller;

use PDO;
use src\router\Request;
use src\utils\Conexao;

class ControllerPessoa
{

    public function getAll()
    {
        $conn = Conexao::CNX();
        $conn->connect();
        $conn->prepare("SELECT * FROM public.pessoas");
        $conn->execute();
        $result = $conn->fetchAll(PDO::FETCH_OBJ);
        $conn->disconnect();
        echo json_encode($result);
    }

    public function getQtd()
    {
        $conn = Conexao::CNX();
        $conn->connect();
        $conn->prepare("SELECT COUNT(1) FROM public.pessoas");
        $conn->execute();
        $result = $conn->fetch(PDO::FETCH_OBJ);
        $conn->disconnect();
        echo json_encode($result);
    }

    public function insert()
    {
        Request::initPostFromPhpInput();
        $conn = Conexao::CNX();
        $conn->connect();
        $conn->prepare("INSERT 
                          INTO public.pessoas (nome, sobrenome, apelido, data_nascimento, sexo)
                         VALUES (:nome, :sobrenome, :apelido, :dataNascimento, :sexo)");

        $conn->bindValue(':nome', Request::postInputAsString('nome'), PDO::PARAM_STR);
        $conn->bindValue(':sobrenome', Request::postInputAsString('sobrenome'), PDO::PARAM_STR);
        $conn->bindValue(':apelido', Request::postInputAsString('apelido'), PDO::PARAM_STR);
        $conn->bindValue(':dataNascimento', Request::postInputAsString('dataNascimento'), PDO::PARAM_STR);
        $conn->bindValue(':sexo', Request::postInputAsString('sexo'), PDO::PARAM_INT);
        $result = $conn->execute();
        $conn->disconnect();
        echo json_encode($result);
    }

    public function update()
    {
        Request::initPostFromPhpInput();
        $conn = Conexao::CNX();
        $conn->connect();
        $conn->prepare("UPDATE public.pessoas
                           SET (nome, sobrenome, apelido, data_nascimento, sexo) = (:nome, :sobrenome, :apelido, :dataNascimento, :sexo)
                         WHERE id = :id ");

        $conn->bindValue(':nome', Request::postInputAsString('nome'), PDO::PARAM_STR);
        $conn->bindValue(':sobrenome', Request::postInputAsString('sobrenome'), PDO::PARAM_STR);
        $conn->bindValue(':apelido', Request::postInputAsString('apelido'), PDO::PARAM_STR);
        $conn->bindValue(':dataNascimento', Request::postInputAsString('dataNascimento'), PDO::PARAM_STR);
        $conn->bindValue(':sexo', Request::postInputAsString('sexo'), PDO::PARAM_INT);
        $conn->bindValue(':id', Request::postInputAsString('id'), PDO::PARAM_INT);
        $result = $conn->execute();
        $conn->disconnect();
        echo json_encode($result);
    }

    public function delete() 
    {
        Request::initPostFromPhpInput();
        $conn = Conexao::CNX();
        $conn->connect();
        $conn->prepare("DELETE FROM public.pessoas WHERE id = :id");
        $conn->bindValue(':id', Request::postInputAsString('id'), PDO::PARAM_INT);
        $result = $conn->execute();
        $conn->disconnect();
        echo json_encode($result);
    }
}
