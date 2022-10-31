<?php
	
	class Usuario {
		
		private $conexao;
		private $name;
		private $email;
		private $usuario;
		private $senha;
		
		public function getConexao() { return $this->conexao; }
		
		public function setConexao($conexao) { $this->conexao = $conexao; }
		
		public function getName() { return $this->name; }
		
		public function setName($name) { $this->name = $name; }

		public function getEmail() { return $this->email; }
		
		public function setEmail($email) { $this->email = $email; }

		public function getUsuario() { return $this->usuario; }
		
		public function setUsuario($usuario) { $this->usuario = $usuario; }
		
		public function getSenha() { return $this->senha; }
		
		public function setSenha($senha) { $this->senha = $senha; }
		
		public function __construct($conexao) {
			$this->conexao = $conexao;
		}
		
		public function Inserir() {
			$sql = "INSERT INTO usuarios(name, email, usuario, senha) VALUES (?, ?, ?, ?)";
			$insert_preparado = $this->conexao->prepare($sql);
			$insert_preparado->bind_param('ssss', $this->name, $this->email, $this->usuario, $this->senha);
			return $insert_preparado->execute();
		}
		
		public function Alterar() {
			$sql = "UPDATE usuarios SET usuario = ?, senha = ? WHERE usuario = ?";
			$update_preparado = $this->conexao->prepare($sql);
			$update_preparado->bind_param('sss', $this->usuario, $this->senha, $this->usuario);
			return $update_preparado->execute();
		}
		
		public function PegarCod($usuario){
			$sql = "SELECT cod_usuario from usuarios where usuario = ?";	
			$sql_preparado = $this->conexao->prepare($sql);
			$sql_preparado->bind_param('s', $usuario);

			if($sql_preparado->execute()){
				$result = $sql_preparado->get_result();

				$registro = $result->fetch_object();

			}	

			return $registro->cod_usuario;
		}

		public function TrocaSenha() {
				$sql = "UPDATE usuarios SET senha = ? Where usuario = ?";
				$update_preparado = $this->conexao->prepare($sql);
				$update_preparado->bind_param('ss', $this->senha, $this->usuario);
				return $update_preparado->execute();
		}

		public function Excluir() {
			$sql = "DELETE FROM usuarios WHERE usuario = ?";
			$delete_preparado = $this->conexao->prepare($sql);
			$delete_preparado->bind_param('s', $this->usuario);
			return $delete_preparado->execute();
		}

		public function Carregar($usuario) {
			$sql = "SELECT * FROM usuarios WHERE usuario = ?";
			$select_preparado = $this->conexao->prepare($sql);
			$select_preparado->bind_param('s', $usuario);
			 
			if ($select_preparado->execute()) {
				$resultados = $select_preparado->get_result();
				if ($resultados->num_rows > 0) {
					$registro = $resultados->fetch_object();
					
					$this->usuario 	= $registro->usuario;
					$this->senha = $registro->senha;
					
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
			
		}
		
	}

?>