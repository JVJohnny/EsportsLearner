<?php
	
	class Rating {
		
		private $conexao;
		private $nota;
		private $cod;
		private $cod_vid;

		public function getConexao() { return $this->conexao; }
		
		public function setConexao($conexao) { $this->conexao = $conexao; }
		
		public function getNota() { return $this->nota; }
		
		public function setNota($nota) { $this->nota = $nota; }

        public function getCod() { return $this->cod; }
		
		public function setCod($cod) { $this->cod = $cod; }

		public function getCod_Vid() { return $this->cod_vid; }
		
		public function setCod_Vid($cod_vid) { $this->cod_vid = $cod_vid; }
		
		public function __construct($conexao) {
			$this->conexao = $conexao;
		}
		
		public function Inserir() {
			$sql = "INSERT INTO rating(cod_notas, nota, cod_vid) VALUES (?, ?, ?)";
			$insert_preparado = $this->conexao->prepare($sql);
			$insert_preparado->bind_param('idi', $this->cod, $this->nota, $this->cod_vid);
			return $insert_preparado->execute();
		}
		
		public function Media($parametro){
			$sql = "SELECT round(SUM(nota)/count(*),2) as soma from rating where cod_vid = ?";	
			$select_preparado = $this->conexao->prepare($sql);
			$select_preparado->bind_param('i', $parametro);
			

			if ($select_preparado->execute()) {
				$result = $select_preparado->get_result();
				if ($result->num_rows > 0) {

				$registro = $result->fetch_object();

				return $registro->soma;
				}
			}
				
		}	

		public function PegarCodVid($cod, $cod2) {
			$sql = "SELECT cod_vid, cod_notas from rating where cod_vid = ? and cod_notas = ?";	
			$sql_preparado = $this->conexao->prepare($sql);
			$sql_preparado->bind_param('ii', $cod, $cod2);

			$sql_preparado->execute();

			if ($sql_preparado->execute()) {
				$resultados = $sql_preparado->get_result();
				if ($resultados->num_rows > 0) {
			
					return $resultados->num_rows;
				} else {
					return false;
				}
			
		}
			
		}


		public function PegarCod($cod_vid){
			$sql = "SELECT cod_vid from rating where cod_vid = ?";	
			$sql_preparado = $this->conexao->prepare($sql);
			$sql_preparado->bind_param('i', $cod_vid);

			if($sql_preparado->execute()){
				$result = $sql_preparado->get_result();

				$registro = $result->fetch_object();

			}	

			return $registro->cod_vid;
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