<?php

class Videos{
		
		private $conexao;
        private $cod_videos;
		private $url_embed;
		private $categoria;
		private $titulo;
        private $media;
        private $cod_usuario;
        

		public function getConexao() { return $this->conexao; }
		
		public function setConexao($conexao) { $this->conexao = $conexao; }

        public function getCod_videos() { return $this->cod_videos; }
		
		public function setCod_videos($cod_videos) { $this->cod_videos = $cod_videos; }
		
		public function getURL() { return $this->url_embed; }
		
		public function setURL($url_embed) { $this->url_embed = $url_embed; }

        public function getCategoria() { return $this->categoria; }
		
		public function setCategoria($categoria) { $this->categoria = $categoria; }

		public function getTitulo() { return $this->titulo; }
		
		public function setTitulo($titulo) { $this->titulo = $titulo; }

        public function getMedia() { return $this->media; }
		
		public function setMedia($media) { $this->media = $media; }

        public function getCod_usuario() { return $this->cod_usuario; }
		
		public function setCod_usuario($cod_usuario) { $this->cod_usuario = $cod_usuario; }

		public function __construct($conexao) {
			$this->conexao = $conexao;
		}
		
		public function Inserir(){
			$sql ="INSERT INTO videos(url_embed, categoria, titulo, media, cod_usuario) values(?,?,?,?,?)";	
			$insert_preparado = $this->conexao->prepare($sql);
			$insert_preparado->bind_param('ssssi', $this->url_embed, $this->categoria, $this->titulo, $this->media, $this->cod_usuario);
			return $insert_preparado->execute();

		}

		
		
        public function Atualizar(){
            $sql = "UPDATE VIDEOS set media = ? where cod_videos = ?";
            $update_preparado = $this->conexao->prepare($sql);
            $update_preparado->bind_param('di', $this->media, $this->cod_videos);
            return $update_preparado->execute();
           
        }

			
		public function Carregar($url) {
			$sql = "SELECT * FROM videos WHERE url_embed = ?";
			$select_preparado = $this->conexao->prepare($sql);
			$select_preparado->bind_param('s', $url);
			
			if ($select_preparado->execute()) {
				$resultados = $select_preparado->get_result();
				if ($resultados->num_rows > 0) {
							
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