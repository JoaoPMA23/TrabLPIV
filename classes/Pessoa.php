<?php



    Class Pessoa{
        protected $id;
        protected $nome;
        protected $email;
        protected $telefone;


        public function _construct($nome="",$email="",$telefone=""){
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
        }

        public function getId(){
            return $this-> id;
        }
        public function setId(){
            return $this-> $id;
        }
        public function getNome(){
            return $this-> nome;
        }
        public function setNome(){
            return $this-> $nome;
        }
        public function getEmail(){
            return $this-> email;
        }
        public function setEmail(){
            return $this-> $email;
        }
        public function getTelefone(){
            return $this-> telefone;
        }
        public function setTelefone(){
            return $this-> $telefone;
        }
        public function ExibirResumo(){
            return "Nome" .$this->nome. "| Contato" . $this->email;
        }
    }