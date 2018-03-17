<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sys
 * @author Wesley - SPI3B
 */
class Toten {

    private $aStatic;
    private $error;
    private $curso;
    private $db;
    private $status;

    const bk = "animefast";
    const tc = "curso";
    const ts = "statistics";

    public function __construct($curso, $senha) {
        $this->error = FALSE;
        $this->db = $this->connectDb();
        if ($this->db) {
            $this->connectSys($curso, $senha);
        }
    }

    /* Tenta conectar ao banco de dados */

    private function connectDb() {
        try {
            $db = new PDO("mysql:host=127.0.0.1;dbname=" . self::bk, "root", "wes123");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* Retorna a class PDO conectada */
            return $db;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return FALSE;
        }
    }

    private function connectSys($curso, $senha) {
        try {
            $consulta = $this->db->prepare("SELECT * FROM `" . self::tc . "` WHERE curso = :curso AND senha = :senha");
            $consulta->bindValue(":curso", $curso, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $senha, PDO::PARAM_STR);
            $consulta->execute();
            if ($consulta->rowCount() > 0) {
                $data = $consulta->fetch(PDO::FETCH_ASSOC);
                $this->curso = $data["tabela"];
                $this->status = TRUE;
                return TRUE;
            } else {
                $this->error = "Login incorreto ou inexistente!";
                return FALSE;
            }
        } catch (PDOException $e) {
            $this->error = $e->errorInfo;
            return FALSE;
        }
    }

    public function status() {
        return $this->status;
    }

    public function getError() {
        if (is_array($this->error)) {
            return "Servidor: " . implode(' ', $this->error);
        } else {
            return $this->error;
        }
    }

    public function rec($a) {
        try {
            $rec = $this->db->prepare("INSERT INTO `avaliadores`( `nome`, `email`, `sexo`, `idade`, `gostou`, `ngostou`, `nfarei`, `tfarei`, `farei`, `hora`) VALUES (:nm,:em,:se,:id,:g,:ng,:nf,:tf,:f,:h)");
            $rec->bindValue(':nm', $a['nome'], PDO::PARAM_STR);
            $rec->bindValue(':em', $a['email'], PDO::PARAM_STR);
            $rec->bindValue(':se', $a['sexo'], PDO::PARAM_STR);
            $rec->bindValue(':id', $a['idade'], PDO::PARAM_INT);
            $rec->bindValue(':g', $a['gostei'], PDO::PARAM_BOOL);
            $rec->bindValue(':ng', $a['ngostei'], PDO::PARAM_BOOL);
            $rec->bindValue(':nf', $a['nfarei'], PDO::PARAM_BOOL);
            $rec->bindValue(':tf', $a['tfarei'], PDO::PARAM_BOOL);
            $rec->bindValue(':f', $a['farei'], PDO::PARAM_BOOL);
            $rec->bindValue(':h', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $rec->execute();
            if ($this->db->lastInsertId() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            $this->error = $e->errorInfo;
            return FALSE;
        }
    }

    private function select() {
        try {
            $g = $this->db->prepare("SELECT `id` FROM `avaliadores` WHERE gostou = 1");
            $g->execute();
            $g = $g->rowCount() > 0 ? $g->rowCount() : 0;

            $ng = $this->db->prepare("SELECT `id` FROM `avaliadores` WHERE ngostou = 1");
            $ng->execute();
            $ng = $ng->rowCount() > 0 ? $ng->rowCount() : 0;

            $nf = $this->db->prepare("SELECT `id` FROM `avaliadores` WHERE nfarei = 1");
            $nf->execute();
            $nf = $nf->rowCount() > 0 ? $nf->rowCount() : 0;

            $tf = $this->db->prepare("SELECT `id` FROM `avaliadores` WHERE tfarei = 1");
            $tf->execute();
            $tf = $tf->rowCount() > 0 ? $tf->rowCount() : 0;

            $f = $this->db->prepare("SELECT `id` FROM `avaliadores` WHERE farei = 1");
            $f->execute();
            $f = $f->rowCount() > 0 ? $f->rowCount() : 0;

            return ['happy' => $g, 'bad' => $ng, 'not' => $nf, 'maybe' => $tf, 'yes' => $f];
        } catch (PDOException $e) {
            $this->error = $e->errorInfo;
            return FALSE;
        }
    }

    public function getStatic() {
        return $this->select();
    }

}
